<?php
// api/src/Controller/CreateMediaObjectAction.php

namespace App\Controller\User;

use App\Entity\MediaObject;
use App\Repository\MediaObjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateMediaObjectAction
{

    /**
     * @var MediaObjectRepository
     */
    private $mediaRepository;
    /**
     * @var UserRepository
     */
    private $repository;
    /**
     * @var ParameterBagInterface
     */
    private $parameterBag;
    /**
     * @var EntityManagerInterface
     */
    private $em;

    /**
     * CreateMediaObjectAction constructor.
     * @param ParameterBagInterface $parameterBag
     * @param UserRepository $userRepository
     * @param EntityManagerInterface $entityManager
     * @param MediaObjectRepository $media
     */

    public function __construct(ParameterBagInterface $parameterBag, UserRepository $userRepository, EntityManagerInterface $entityManager, MediaObjectRepository $media)
    {
        $this->em = $entityManager;
        $this->repository = $userRepository;
        $this->parameterBag = $parameterBag;
        $this->mediaRepository = $media;
    }

    /**
     * @param Request $request
     * @param MediaObjectRepository $mediarepo
     * @return MediaObject
     */
    public function __invoke(Request $request): MediaObject
    {
        $uploadedFile = $request->files->get('file');
        $user = $this->repository->find($request->request->get('user'));

        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new MediaObject();
        $mediaObject->file = $uploadedFile;
        $mediaObject->setUser($user);

        return $mediaObject;
    }
}