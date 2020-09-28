<?php

namespace App\Controller\ResetPasswordRequest;

use App\Entity\ResetPasswordRequest;
use App\Repository\ResetPasswordRequestRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use DateTime;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class ResetPasswordRequestController extends AbstractController
{
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * ResetPasswordRequestController constructor.
     * @param ResetPasswordRequest $resetPasswordRequest
     */
    public function __construct(ResetPasswordRequestRepository $resetPasswordRequest, EntityManagerInterface $em){
        $this->repository = $resetPasswordRequest;
        $this->em = $em;
    }
    /**
     * @Route("/api/reset/password", name="app_reset_password")
     */
    public function reset(Request $request, UserPasswordEncoderInterface $passwordEncoder)
    {
        $body = json_decode($request->getContent(), true);
        $requestPassword = $this->repository->findOneBy(['token' => $body['token']]);

        if($requestPassword){

            $timeLife = $requestPassword->getExpiresAt()->getTimestamp();
            $now = new DateTime();
            if ($timeLife >= $now->getTimestamp()) {

                $user = $requestPassword->getUser();
                $user->setPassword($passwordEncoder->encodePassword($user, $body['password']));
                $this->em->persist($user);
                $this->em->remove($requestPassword);
                $this->em->flush();

                return new JsonResponse(['success'=>true], Response::HTTP_OK);
            }
            return new JsonResponse(['error' => "Oops trop lent, le token a expiré",], Response::HTTP_BAD_REQUEST);
        }

        return new JsonResponse(['error' => "Aucune demande n'a été trouvé"], Response::HTTP_BAD_REQUEST);

    }
}