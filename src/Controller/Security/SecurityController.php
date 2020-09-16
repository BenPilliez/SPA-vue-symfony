<?php

namespace App\Controller\Security;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

/**
 * Class SecurityController
 * @package App\Controller\Security
 * @Route ("/api")
 */
class SecurityController extends AbstractController
{
    /**
     * @Route("/login_check", name="app_login_check", methods={"POST"})
     */
    public function login_check()
    {
    }

    /**
     * @Route("/loggedUser", name="app_login", methods={"GET"})
     */
    public function loggedUser()
    {

        return $this->json([
            'user' => $this->getUser() ? $this->getUser()->getInfo() : null
        ]);
    }

    /**
     * @throws \Exception
     * @Route ("/logout", name="app_logout")
     */
    public function logout()
    {
        return new JsonResponse(['authenticated' => false], Response::HTTP_OK);
    }
}
