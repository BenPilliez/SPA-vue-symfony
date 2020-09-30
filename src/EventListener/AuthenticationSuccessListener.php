<?php

namespace App\EventListener;

use App\Repository\UserRepository;
use Lexik\Bundle\JWTAuthenticationBundle\Event\AuthenticationSuccessEvent;
use Symfony\Component\Security\Core\User\UserInterface;

class AuthenticationSuccessListener
{
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * AuthenticationSuccessListener constructor.
     * @param UserRepository $user
     */
    public function __construct(UserRepository $user)
    {
        $this->repository = $user;
    }

    public function onAuthenticationSuccessResponse(AuthenticationSuccessEvent $event)
    {
        $user = $event->getUser();

        if (!$user instanceof UserInterface) {
            return;
        }

        $event->setData([
            'code' => $event->getResponse()->getStatusCode(),
            'token' => $event->getData(),
            'user' => $user->getId()
        ]);
    }
}