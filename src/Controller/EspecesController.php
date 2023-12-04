<?php

namespace App\Controller;

use App\Repository\EspeceRepository;
use App\Repository\FamilleAnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EspecesController extends AbstractController
{
    #[Route('/especes/{idFamily}', name: 'app_especes', requirements: ['idFamily' => '\d+'])]
    public function index(int $idFamily, FamilleAnimalRepository $familleAnimalRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        $famille = $familleAnimalRepository->getAllSpecies($idFamily, $search);

        return $this->render('especes/index.html.twig', [
            'species' => $famille,
            'familyName' => $familleAnimalRepository->find($idFamily)?->getNomFamille(),
            'famille' => true,
            'idFamily' => $idFamily,
            'search' => $search,
        ]);
    }

    #[Route('/especes/', name: 'app_especes_showall')]
    public function showAll(EspeceRepository $especeRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');

        return $this->render('especes/index.html.twig', [
            'species' => $especeRepository->getAllSpeciesWithPicture($search),
            'famille' => false,
            'search' => $search,
        ]);
    }
}
