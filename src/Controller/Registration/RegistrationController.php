<?php

namespace App\Controller\Registration;

use App\Entity\Registration;
use DateTime;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class RegistrationController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $entityManager;

    /**
     * RegisterController constructor.
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager;
    }
    /**
     * @Route("/api/users/verify_email", name="user_verify_register", methods={"GET"})
     * @param Request $request
     * @return Response
     */
    public function verifyEmail(Request $request)
    {
        $token = $request->query->get('token');

        $registration = $this->entityManager->getRepository(Registration::class)->findOneBy(['token' => $token]);

        if ($registration) {
            $timeLife = $registration->getExpiresAt()->getTimestamp();
            $now = new DateTime();

            if ($timeLife >= $now->getTimestamp()) {

                $user = $registration->getUser();
                $user->setIsVerified(true);

                $this->entityManager->remove($registration);
                $this->entityManager->persist($user);
                $this->entityManager->flush();

                return $this->render('app.html.twig', [
                    'success' => 'Account has been activated'
                ]);

            }
            return $this->render('app.html.twig', [
                'error' => 'Token expired'
            ]);
        }

        return $this->render('app.html.twig', [
            'error' => 'User not found'
        ]);

    }
}