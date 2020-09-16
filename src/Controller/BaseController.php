<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BaseController extends AbstractController
{
    /**
     * @return Response
     * @Route("/{route}", name="home", requirements={"route" = "^(?!api|_(profiler|wdt)).*"})
     */
    public function index(): Response
    {
        return $this->render('app.html.twig');
    }
}