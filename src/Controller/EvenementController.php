<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Form\EvenementType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/evenement/{id}/update', requirements: ['id' => '\d+'])]
    public function update(Evenement $event, Request $request, EntityManagerInterface $entityManager): Response
    {
        $form = $this->createForm(EvenementType::class, $event);
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $entityManager->flush();

            return $this->redirectToRoute('');
        }

        return $this->render('evenement/update.html.twig', [
            'event' => $event,
            'form' => $form,
        ]);
    }

    #[Route('/evenement/create')]
    public function create(): Response
    {
        return $this->render('evenement/create.html.twig');
    }
}
