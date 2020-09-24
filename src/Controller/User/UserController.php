<?php
namespace App\Controller\User;

use App\Entity\User;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @package App\Controller\User
 */
class UserController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var UserRepository
     */
    private $repository;

    /**
     * UserController constructor.
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     */

    public function __construct(UserRepository $userRepository, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $userRepository;
    }

    /**
     * @Route(
     *     name="password_update",
     *     path="/api/users/{id}/password/update",
     *     methods={"PUT"},
     *     defaults={
     *         "_api_resource_class"=User::class,
     *         "_api_item_operation_name"="update_password"
     *     }
     * )
     */

    public function update_password(Request $request, User $user, UserPasswordEncoderInterface $passwordEncoder ) : JsonResponse
    {
        $body = json_decode($request->getContent(), true);

        if($user->getPlainPassword() !== $body['old_password'])
        {
            return new JsonResponse(['error' => "Ton ancien mot de passe ne correspond pas"], Response::HTTP_INTERNAL_SERVER_ERROR);
        }

        $user->setPassword($passwordEncoder->encodePassword($user,$body['password']));
        $this->em->persist($user);
        $this->em->flush();

        return new JsonResponse(['success' => true], Response::HTTP_OK);

    }
}