<?php

namespace App\Controller\Admin;

use App\Entity\Chat;
use App\Entity\User;
use App\Entity\Rental;
use App\Entity\Picture;
use App\Entity\Equipment;
use App\Entity\RentalEquipment;
use App\Controller\Admin\RentalCrudController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'app_admin')]
    #[IsGranted("ROLE_ADMIN")]
    public function index(): Response
    {
       
      
        $adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        return $this->redirect($adminUrlGenerator->setController(RentalCrudController::class)->generateUrl());

    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Louer Serein');
    }

    public function configureMenuItems(): iterable
    {
        
        yield MenuItem::linkToCrud('Locations', 'fas fa-building', Rental::class);
        yield MenuItem::linkToCrud('Équipements', 'fas fa-info-circle', Equipment::class);
        // yield MenuItem::linkToCrud('Équipements de la location', 'fas fa-info-circle', RentalEquipment::class);
        yield MenuItem::linkToCrud('Images', 'fas fa-tag', Picture::class);
        yield MenuItem::linkToCrud('Messagerie', 'fas fa-envelope', Chat::class);
        yield MenuItem::linkToCrud('Utilisateurs', 'fas fa-user', User::class);
    }
}
