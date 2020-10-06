<?php
// api/src/Controller/CreateMediaObjectAction.php

namespace App\Controller\Games;

use App\Entity\GameImage;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\DependencyInjection\ParameterBag\ParameterBagInterface;

final class DeleteMediaObjectAction extends AbstractController
{

    /**
     * @var EntityManagerInterface
     */
    private $em;
    private $parameterBag;

    public function __construct(EntityManagerInterface $entityManager,ParameterBagInterface $parameterBag)
    {
        $this->em = $entityManager;
        $this->parameterBag= $parameterBag;
    }
    public function __invoke(GameImage $gameImage)
    {
        $webPath = $this->parameterBag->get('kernel.project_dir') . '/public/games/' . $gameImage->getFilePath();

        if(file_exists($webPath)){
            unlink($webPath);
        }

        $this->em->remove($gameImage);
        $this->em->flush();

        return $gameImage;
    }
}