<?php

namespace App\Controller\User;

use App\Entity\MediaObject;
use App\Repository\MediaObjectRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;
use Symfony\Component\Validator\Constraints\Json;

class EditAvatarController
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
     * @param $file
     * @param Request $request
     * @return MediaObject
     */
    public function __invoke(MediaObject $file, Request $request): MediaObject
    {

        $webPath = $this->parameterBag->get('kernel.project_dir') . '/public/media/avatars/' . $file->getFilePath();
        $dont_touch = ['gamer.jpg', 'gamer-app.jpg', 'girl-1.jpg', 'girl-2.jpg'];

        $uploadedFile = $request->files->get('file');

        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $this->em->remove($file);
        $this->em->flush();

        $media = new MediaObject();
        $media->file = $uploadedFile;
        $media->setUser($file->getUser());

        return $media;
    }
}