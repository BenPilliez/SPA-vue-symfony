<?php

namespace App\Controller\Games;

use App\Entity\Game;
use App\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;


class GameController extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route(
     *     name="delete_from_library",
     *     path="/api/games/{id}/delete/{user}",
     *     methods={"PATCH"},
     *     defaults={
     *         "_api_resource_class"=Game::class,
     *         "_api_item_operation_name"="removeFromLibrary"
     *     }
     * )
     */
    public function deleteFromLibrary(Game $game, User $user)
    {
        $game->removeUser($user);
        $this->em->flush();

        return $game;
    }

    /**
     * @Route(
     *     name="add_to_library",
     *     path="/api/games/{id}/add/{user}",
     *     methods={"POST"},
     *     defaults={
     *         "_api_resource_class"=Game::class,
     *         "_api_item_operation_name"="addToLibrary"
     *     }
     * )
     */
    public function addToLibrary(Game $game, User $user)
    {

        $game->addUser($user);
        $this->em->persist($game);
        $this->em->flush();

        return $game->getUsers();
    }
}