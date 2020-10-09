<?php
// api/src/Controller/CreateMediaObjectAction.php

namespace App\Controller\Games;

use App\Entity\GameImage;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpKernel\Exception\BadRequestHttpException;

final class CreateMediaObjectAction
{
    public function __invoke(Request $request): GameImage
    {
        $uploadedFile = $request->files->get('file');
        if (!$uploadedFile) {
            throw new BadRequestHttpException('"file" is required');
        }

        $mediaObject = new GameImage();
        $mediaObject->setName(explode('.', $uploadedFile->getClientOriginalName())[0]);
        $mediaObject->file = $uploadedFile;

        return $mediaObject;
    }
}