<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ReactController extends AbstractController
{
    #[Route('/{reactrouting}', name: 'app_react', requirements: ['reactrouting' => '^(?!login|register).+'], defaults: ['reactrouting' => null])]
    public function index(): Response
    {
        return $this->render('react/index.html.twig', []);
    }
}
