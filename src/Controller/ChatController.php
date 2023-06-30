<?php

namespace App\Controller;

use App\Entity\Chat;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class ChatController extends AbstractController
{
    private $entityManager; // Déclarez une propriété privée pour stocker l'instance de l'EntityManager

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->entityManager = $entityManager; // Injectez l'EntityManager via le constructeur
    }

    #[Route('/chat', name: 'app_chat')]
    #[IsGranted("ROLE_USER")]
    public function index(): Response
    {
        $chatRepository = $this->entityManager->getRepository(Chat::class);
        $chats = $chatRepository->findAll();

        $user = $this->getUser();


        return $this->render('chat/index.html.twig', [
            'controller_name' => 'ChatController',
            'user' => $user,
            'chats' => $chats,

        ]);
    }

    private function getSender(): ?string
    {
        // Récupérer l'utilisateur connecté
        $user = $this->getUser();

        // Vérifier si l'utilisateur existe
        if (!$user) {
            return null;
        }

        // Récupérer l'expéditeur du chat en fonction de l'utilisateur
        // Vous devrez adapter cette logique à votre propre modèle de données
        $sender = $this->getSender();

        // Vérifier si l'expéditeur existe
        if (!$sender) {
            return null;
        }

        // Retourner le nom de l'expéditeur
        return $this->render('chat/index.html.twig', [
            'sender' => $sender
        ]);
    }
}
