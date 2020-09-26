<?php

namespace App\Controller\Availibilities;

use App\Entity\User;
use App\Entity\UserAvailibility;
use App\Repository\UserAvailibilityRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;

final class GetAvailibilitesController extends AbstractController
{
    /**
     * @var UserAvailibilityRepository
     */
    private $repository;
    /**
     * @var UserRepository
     */
    private $userRepository;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(UserRepository $userRepository, UserAvailibilityRepository $availibilityRepository, EntityManagerInterface $em)
    {
        $this->repository = $availibilityRepository;
        $this->userRepository = $userRepository;
        $this->em = $em;
    }

    public function __invoke(Request $request, User $user): JsonResponse
    {
        return $this->json($this->repository->findBy(['user' => $user]));
    }

}