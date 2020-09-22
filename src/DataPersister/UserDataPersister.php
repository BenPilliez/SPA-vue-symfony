<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Registration;
use App\Entity\User;
use App\Entity\UserConfig;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Routing\RouterInterface;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class UserDataPersister implements DataPersisterInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var DataPersisterInterface
     */
    private $decorated;
    /**
     * @var MailerInterface
     */
    private $mailer;
    /**
     * @var RouterInterface
     */
    private $router;
    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;
    private $userPasswordEncoder;

    /**
     * UserDataPersister constructor.
     * @param TokenGeneratorInterface $tokenGenerator
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface $mailer
     * @param RouterInterface $router
     * @param UserPasswordEncoderInterface $passwordEncoder
     */

    public function __construct(TokenGeneratorInterface $tokenGenerator, EntityManagerInterface $entityManager, MailerInterface $mailer,
                                RouterInterface $router, UserPasswordEncoderInterface $passwordEncoder)
    {

        $this->em = $entityManager;
        $this->mailer = $mailer;
        $this->router = $router;
        $this->tokenGenerator = $tokenGenerator;
        $this->userPasswordEncoder = $passwordEncoder;
    }

    public function supports($data): bool
    {
        return $data instanceof User;
    }

    public function persist($data)
    {

        $data->setPassword(
            $this->userPasswordEncoder->encodePassword($data, $data->getPlainPassword())
        );
        $data->eraseCredentials();
        $registration = $this->registration($data);
        $this->sendMail($data, $registration->getToken());
        $this->em->persist($data);
        $this->em->flush();

        return $data;
    }

    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }

    private function registration(User $user)
    {
        $registration = new Registration();

        $token = $this->tokenGenerator->generateToken();
        $registration->setToken($token);

        $date = new DateTime();
        $date->add(new DateInterval('PT1H'));
        $registration->setExpiresAt($date);
        $registration->setUser($user);

        $this->em->persist($registration);
        $this->em->flush();

        return $registration;
    }

    private function sendMail(User $user, String $token)
    {
        $url = $this->generateUrl('user_verify_register', ['token' => $token]);
        $email = (new TemplatedEmail())
            ->from(new Address('gamers-seek@benpilliez.fr', 'Gamers-seek Bot'))
            ->to($user->getEmail())
            ->subject('Please confirm your account')
            ->htmlTemplate('Registration/confirmation_email.html.twig')
            ->context([
                'url' => $url,
                'tokenLifetime' => '3600',
            ]);
        $this->mailer->send($email);
    }

    private function generateUrl(string $string, array $array)
    {
        return $this->router->generate($string, $array, UrlGeneratorInterface::ABSOLUTE_URL);
    }


}