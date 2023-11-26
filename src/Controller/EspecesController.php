<?php

namespace App\Controller;

use App\Repository\EspeceRepository;
use App\Repository\FamilleAnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EspecesController extends AbstractController
{

    #[Route('/especes/{idFamily}', name: 'app_especes', requirements: ['idFamily' => '\d+'])]
    public function index(int $idFamily, FamilleAnimalRepository $familleAnimalRepository): Response
    {
        $famille = $familleAnimalRepository->getAllSpecies($idFamily);

        return $this->render('especes/index.html.twig', [
            'species' => $famille->getEspeces(),
            'familyName' => $famille->getNomFamille(),
            'famille' => true,
        ]);
    }

    #[Route('/especes/', name: 'app_especes_showall')]
    public function showAll(EspeceRepository $especeRepository): Response
    {
        return $this->render('especes/index.html.twig', [
            'species' => $especeRepository->getAllSpeciesWithPicture(),
            'famille' => false,
        ]);
    }
}
