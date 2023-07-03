<?php

namespace App\Controller;

use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ReactController extends AbstractController
{
    #[Route('/{reactrouting}', name: 'app_react', requirements: ['reactrouting' => '^(?!login|register|user_profile|logout|rental|admin|rental_delete|rental_edit|rental_show|rental_new|chat).+'], defaults: ['reactrouting' => null])]
    // #[IsGranted("ROLE_USER")]
    public function index(): Response
    {
        return $this->render('react/index.html.twig', []);
    }
}
