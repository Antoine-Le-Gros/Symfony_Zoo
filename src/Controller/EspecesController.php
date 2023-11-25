<?php

namespace App\Controller;

use App\Repository\CategorieAnimalRepository;
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
        ]);
    }
}
