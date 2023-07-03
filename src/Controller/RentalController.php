<?php

namespace App\Controller;

use App\Entity\Rental;
use App\Form\RentalType;
use App\Repository\RentalRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\SecurityBundle\Security;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Attribute\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

#[Route('/rental')]

class RentalController extends AbstractController
{
    #[Route('/', name: 'app_rental_index', methods: ['GET'])]
    #[IsGranted('ROLE_USER')]
    public function index(RentalRepository $rentalRepository): Response
    {
        return $this->render('rental/index.html.twig', [
            'rentals' => $rentalRepository->findAll(),
        ]);
    }

    #[Route('/new', name: 'app_rental_new', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function new(Request $request, RentalRepository $rentalRepository, EntityManagerInterface $manager): Response
    {
        $rental = new Rental();

        $form = $this->createForm(RentalType::class, $rental);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
           
            $rental->setOwner($this->getUser());

            $manager->persist($rental);
            $manager->flush();

            $this->addFlash(
            'success',
            'Votre location a été ajoutée avec succès.'
        );

            return $this->redirectToRoute('app_user_profile', [], Response::HTTP_SEE_OTHER);
        }

        return $this->render('rental/new.html.twig', [
            'rental' => $rental,
            'form' => $form->createView(),
        ]);
    }

    #[Route('/{id}', name: 'app_rental_show', methods: ['GET'])]
    // #[IsGranted('ROLE_USER')]
    public function show(Rental $rental): Response
    {
        return $this->render('rental/show.html.twig', [
            'rental' => $rental,
            
        ]);
    }

    #[Route('/{id}/edit', name: 'app_rental_edit', methods: ['GET', 'POST'])]
    #[IsGranted('ROLE_USER')]
    public function edit(Request $request, Rental $rental, RentalRepository $rentalRepository, EntityManagerInterface $manager): Response
    {
       
        $form = $this->createForm(RentalType::class, $rental);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $rental = $form->getData();
            $manager->persist($rental);
            $manager->flush();
            $this->addFlash(
                'success',
                'votre location a été modifié avec succès'
            );
            return $this->redirectToRoute('app_user_profile', [], Response::HTTP_SEE_OTHER);
        }
        return $this->render('rental/edit.html.twig', [

            'form' => $form->createView(),
        ]);

    }

    #[Security("is_granted('ROLE_USER') and ( user === rental.getUser()")]
    #[Route('/{id}', name: 'app_rental_delete', methods: ['POST'])]
    public function delete(Request $request, Rental $rental, RentalRepository $rentalRepository, EntityManagerInterface $manager)
    : Response
    {

        // if ($this->isCsrfTokenValid('delete'.$rental->getId(), $request->request->get('_token'))) {
        //     $rentalRepository->remove($rental, true);
        // }
        // return $this->redirectToRoute('app_rental_index', [], Response::HTTP_SEE_OTHER);
        $manager->remove($rental);
        $manager->flush();
        $this->addFlash(
            'success',
            'Votre recette a été modifié avec succès!'
        );
        return $this->redirectToRoute('app_user_profile');
    }
    }

