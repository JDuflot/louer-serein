<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AddRentalController extends AbstractController
{
    #[Route('/add_rental', name: 'app_add_rental')]
    public function index(): Response
    {
        return $this->render('add_rental/index.html.twig', [
            'controller_name' => 'AddRentalController',
        ]);
    }
}
