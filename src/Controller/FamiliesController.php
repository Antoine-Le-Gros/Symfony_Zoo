<?php

namespace App\Controller;

use App\Repository\CategorieAnimalRepository;
use App\Repository\FamilleAnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FamiliesController extends AbstractController
{
    #[Route('/families/{idCategory}', name: 'app_families', requirements: ['idCategory' => '\d+'])]
    public function index(int $idCategory, CategorieAnimalRepository $categorieAnimalRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        return $this->render('families/index.html.twig', [
            'families' => $categorieAnimalRepository->getAllFamilies($idCategory),
            'categoryName' => $categorieAnimalRepository->find($idCategory)->getNomCategorie(),
            'category' => true,
            'idCategory' => $idCategory,
            'search' => $search,
        ]);
    }

    #[Route('/families/', name: 'app_families_showall')]
    public function showAll(FamilleAnimalRepository $familleAnimalRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');

        return $this->render('families/index.html.twig', [
            'families' => $familleAnimalRepository->getAllFamiliesWithPicture(),
            'category' => false,
            'search' => $search,
        ]);
    }
}
