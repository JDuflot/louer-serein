<?php

namespace App\Controller;

use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;

// use Symfony\Component\HttpFoundation\Request;


class UserProfileController extends AbstractController
{
    // Request $request
    #[Route('/user_profile', name: 'app_user_profile')]
    #[IsGranted("ROLE_USER")]
    public function profile(): Response
    {

        $user = $this->getUser(); // je recupère l'utilisateur connecté
        return $this->render('user_profile/index.html.twig', [
            'controller_name' => 'UserProfileController',
            'user' => $user,

        ]);
    }
}
