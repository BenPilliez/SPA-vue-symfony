<?php

namespace App\Controller\Avatar;

use App\Entity\User;
use App\Repository\MediaObjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\ParameterBag;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\MediaObject;

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
     * @var ParameterBag
     */
    private $parameterBag;

    /**
     * UserController constructor.
     * @param MediaObjectRepository $userRepository
     * @param EntityManagerInterface $entityManager
     */

    public function __construct(ParameterBagInterface $parameterBag, UserRepository $userRepository, MediaObjectRepository $mediaObjectRepository, EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
        $this->repository = $mediaObjectRepository;
        $this->userRepository = $userRepository;
        $this->parameterBag = $parameterBag;


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
        $webPath = $this->parameterBag->get('kernel.project_dir') . '/public/media/avatars/' . $mediaObject->getFilePath();
        $dont_touch = ['gamer.jpg', 'gamer-app.jpg', 'girl-1.jpg', 'girl-2.jpg'];

        if (!in_array($mediaObject->getFilePath(), $dont_touch)) {
            unlink($webPath);
        }

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