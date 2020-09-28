<?php


namespace App\DataPersister;

use ApiPlatform\Core\DataPersister\DataPersisterInterface;
use App\Entity\ResetPasswordRequest;
use App\Repository\UserRepository;
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

class ResetPasswordRequestDataPersister implements DataPersisterInterface
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

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
     * @var UserRepository
     */
    private $repository;

    /**
     * PasswordDataPersister constructor.
     * @param TokenGeneratorInterface $tokenGenerator
     * @param EntityManagerInterface $entityManager
     * @param MailerInterface $mailer
     * @param RouterInterface $router
     * @param UserPasswordEncoderInterface $passwordEncoder
     * @param UserRepository $userRepository
     */
    public function __construct(TokenGeneratorInterface $tokenGenerator,
                                EntityManagerInterface $entityManager, MailerInterface $mailer,
                                RouterInterface $router, UserPasswordEncoderInterface $passwordEncoder, UserRepository $userRepository)
    {
        $this->em = $entityManager;
        $this->mailer = $mailer;
        $this->router = $router;
        $this->tokenGenerator = $tokenGenerator;
        $this->userPasswordEncoder = $passwordEncoder;
        $this->repository = $userRepository;
    }

    public function supports($data): bool
    {
        return $data instanceof ResetPasswordRequest;
    }

    public function persist($data)
    {

        $user = $this->repository->findOneBy(['email' => $data->getEmail()]);
        $data->setToken($this->tokenGenerator->generateToken());
        $data->setUser($user);
        $this->sendMail($data);

        $this->em->persist($data);
        $this->em->flush();

        return $data;
    }

    public function remove($data)
    {
        $this->em->remove($data);
        $this->em->flush();
    }

    private function sendMail(ResetPasswordRequest $passwordRequest)
    {
        $url = $this->generateUrl('reset_password', ['token' => $passwordRequest->getToken()]);
        $email = (new TemplatedEmail())
            ->from(new Address('gamers-seek@benpilliez.fr', 'Gamers-seek Bot'))
            ->to($passwordRequest->getUser()->getEmail())
            ->subject('Reset password')
            ->htmlTemplate('Password/email.html.twig')
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