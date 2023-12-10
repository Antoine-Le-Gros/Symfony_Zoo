<?php

namespace App\Controller;

use App\Entity\Evenement;
use App\Repository\EnclosRepository;
use App\Repository\EvenementRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Form\Extension\Core\Type\SubmitType;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/evenement/{idEnclos}', name: 'app_evenement', requirements: ['idEnclos' => '\d+'])]
    public function index(int $idEnclos, EnclosRepository $enclosRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');

        return $this->render('evenement/index.html.twig', [
            'events' => $enclosRepository->getAllEvents($idEnclos, $search),
            'EnclosName' => $enclosRepository->find($idEnclos)?->getNomEnclos(),
            'enclos' => true,
            'search' => $search,
        ]);
    }
    #[Route('/evenement/', name: 'app_evenement_showall')]
    public function showAll(EvenementRepository $evenementRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');

        return $this->render('evenement/index.html.twig', [
            'events' => $evenementRepository->getAll($search),
            'enclos' => false,
            'search' => $search,
        ]);
    }
    #[Route('/evenement/{id}/show', name: 'app_evenement_show', requirements: ['id' => '\d+'])]
    public function show(
        ?Evenement $evenement
    ): Response {
        if (null === $evenement) {
            throw $this->createNotFoundException("l'évènement n'existe pas ");
        }

        return $this->render('evenement/show.html.twig', ['evenement' => $evenement]);
    }
    #[Route('/evenement/{id}/delete', requirements: ['id' => '\d+'])]
    public function delete(Evenement $evenement,
        EntityManagerInterface $entityManager,
        Request $request): Response
    {
        $form = $this->createFormBuilder()
            ->add('delete', SubmitType::class)
            ->add('cancel', SubmitType::class)
            ->getForm();
        $form->handleRequest($request);
        if ($form->isSubmitted()) {
            if ($form->get('delete')->isClicked()) {
                $entityManager->remove($evenement);
                $entityManager->flush();

                return $this->redirectToRoute('app_evenement_showall');
            }

            return $this->redirectToRoute('app_evenement_showall', [
                'id' => $evenement->getId(),
            ]);
        }

        return $this->render('evenement/delete.html.twig', [
            'evenement' => $evenement,
            'form' => $form,
        ]);
    }
    #[Route('/evenement/{id}/update', requirements: ['id' => '\id'])]
    public function update(Evenement $event): Response
    {
        return $this->render('evenement/update.html.twig', [
            'event' => $event,
        ]);
    }
}
