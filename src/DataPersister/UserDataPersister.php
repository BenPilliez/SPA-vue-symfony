<?php

namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\ContextAwareDataPersisterInterface;
use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\Registration;
use App\Entity\User;
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

class UserDataPersister implements ContextAwareDataPersisterInterface
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

    public function __construct(TokenGeneratorInterface $tokenGenerator, ContextAwareDataPersisterInterface $decorated, EntityManagerInterface $entityManager, MailerInterface $mailer,
                                RouterInterface $router, UserPasswordEncoderInterface $passwordEncoder)
    {
        $this->decorated = $decorated;
        $this->em = $entityManager;
        $this->mailer = $mailer;
        $this->router = $router;
        $this->tokenGenerator = $tokenGenerator;
        $this->userPasswordEncoder = $passwordEncoder;
    }

    public function supports($data, array $context = []): bool
    {
        return $this->decorated->supports($data, $context);
    }

    public function persist($data, array $context = [])
    {

        $data->setPassword(
            $this->userPasswordEncoder->encodePassword($data, $data->getPlainPassword())
        );
        $data->eraseCredentials();
        $this->registration($data);
        $result = $this->decorated->persist($data, $context);

        if (
            $data instanceof User && (
                ($context['collection_operation_name'] ?? null) === 'post' ||
                ($context['graphql_operation_name'] ?? null) === 'create'
            )
        ) {
            $this->sendMail($data);
        }
        return $result;
    }

    public function remove($data, array $context = [])
    {
        return $this->decorated->remove($data, $context);
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

        return true;
    }

    private function sendMail(User $user)
    {
        $url = $this->generateUrl('user_verify_register', ['token' => $user->getRegistration()->getToken()]);
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