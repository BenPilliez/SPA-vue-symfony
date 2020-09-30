<?php

namespace App\Controller\Registration;

use App\Entity\Registration;
use App\Entity\User;
use DateInterval;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Routing\Generator\UrlGeneratorInterface;
use Symfony\Component\Security\Csrf\TokenGenerator\TokenGeneratorInterface;

class RegistrationController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;
    /**
     * @var TokenGeneratorInterface
     */
    private $tokenGenerator;
    /**
     * @var MailerInterface
     */
    private $mailer;

    /**
     * RegisterController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager, TokenGeneratorInterface $tokenGenerator, MailerInterface $mailer)
    {
        $this->entityManager = $entityManager;
        $this->tokenGenerator = $tokenGenerator;
        $this->mailer = $mailer;
    }

    /**
     * @Route("/api/users/verify_email", name="user_verify_register", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public
    function verifyEmail(Request $request)
    {
        $token = $request->query->get('token');

        $registration = $this->entityManager->getRepository(Registration::class)->findOneBy(['token' => $token]);

        if ($registration && $registration->getActive() === true) {
            $timeLife = $registration->getExpiresAt()->getTimestamp();
            $now = new DateTime();

            if ($timeLife >= $now->getTimestamp()) {

                $user = $registration->getUser();
                $user->setIsVerified(true);
                $registration->setActive(false);

                $this->entityManager->persist($registration);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $this->redirect('/confirmation?success=true');

            }
            return $this->redirect('/confirmation?error=expiration');
        }

        return $this->redirect('/confirmation?error=user');

    }


    /**
     * @Route(
     *     name="update_token",
     *     path="/api/registrations",
     *     methods={"POST"},
     *     defaults={
     *         "_api_resource_class"=Registration::class,
     *         "_api_collection_operation_name"="token_update"
     *     }
     * )
     */
    public function updateToken(Request $request): JsonResponse
    {
        $body = json_decode($request->getContent(), true);
        $user = $this->entityManager->getRepository(User::class)->find($body['user_id']);
        $registration = $this->entityManager->getRepository(Registration::class)->findOneBy(['user' => $user]);

        if($user->getIsVerified() === false) {
            if ($registration === null) {
                $registration = new Registration();
                $registration->setUser($user);
            }
            $token = $this->tokenGenerator->generateToken();
            $registration->setToken($token);

            $date = new DateTime();
            $date->add(new DateInterval('PT1H'));
            $registration->setExpiresAt($date);
            $registration->setActive(true);

            $url = $this->generateUrl('user_verify_register', ['token' => $token], UrlGeneratorInterface::ABSOLUTE_URL);
            $email = (new TemplatedEmail())
                ->from(new Address('gamers-seek@benpilliez.fr', 'Gamers-app Bot'))
                ->to($user->getEmail())
                ->subject('Confirmation de compte')
                ->htmlTemplate('Registration/confirmation_email.html.twig')
                ->context([
                    'url' => $url,
                    'tokenLifetime' => '3600',
                ]);

            $this->mailer->send($email);

            $this->entityManager->persist($registration);
            $this->entityManager->flush();

            return $this->json(['message' => "Un email avec un lien pour valider ton compte ont été envoyé à " . $user->getEmail()]);
        }

        return $this->json(['message' => "Tu as déjà vérifié ton compte"]);

    }
}