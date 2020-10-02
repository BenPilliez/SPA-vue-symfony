<?php

namespace App\Controller\Avatar;

use App\Entity\User;
use App\Repository\MediaObjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MediaObject;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

/**
 * Class UserController
 * @package App\Controller\User
 */
class AvatarController extends AbstractController
{
    /**
     * @var EntityManagerInterface
     */
    private $em;
    /**
     * @var MediaObjectRepository
     */
    private $repository;
    /**
     * @var MediaObjectRepository|UserRepository
     */
    private $userRepository;

    /**
     * UserController constructor.
     * @param MediaObjectRepository $userRepository
     * @param EntityManagerInterface $entityManager
     */

    public function __construct(UserRepository $userRepository,MediaObjectRepository $mediaObjectRepository, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $mediaObjectRepository;
        $this->userRepository = $userRepository;

    }

    /**
     * @Route(
     *     name="avatar_update",
     *     path="/api/media_objects/exist_avatar/{id}",
     *     methods={"PUT"},
     *     defaults={
     *         "_api_resource_class"=MediaObject::class,
     *         "_api_item_operation_name"="update_avatar"
     *     }
     * )
     */

    public function update(Request $request, MediaObject $mediaObject)
    {
        $body = json_decode($request->getContent(), true);
        $mediaObject->setFilePath($body['imagePath']);
        $this->em->persist($mediaObject);
        $this->em->flush();

        return $mediaObject;
    }

    /**
     * @Route(
     *     name="avatar_create",
     *     path="/api/media_objects/exist_avatar",
     *     methods={"POST"},
     *     defaults={
     *         "_api_resource_class"=MediaObject::class,
     *         "_api_collection_operation_name"="post_avatar"
     *     }
     * )
     */

    public function create(Request $request)
    {
        $body = json_decode($request->getContent(), true);

        $user = $this->userRepository->find($body['user_id']);

        $mediaObject = new MediaObject();
        $mediaObject->setFilePath($body['imagePath']);
        $mediaObject->setUser($user);
        $this->em->persist($mediaObject);
        $this->em->flush();

        return $mediaObject;
    }

}