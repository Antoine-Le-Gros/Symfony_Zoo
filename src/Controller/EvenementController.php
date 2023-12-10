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
}
