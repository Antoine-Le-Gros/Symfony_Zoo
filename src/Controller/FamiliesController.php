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
    public function index(int $idCategory, CategorieAnimalRepository $categorieAnimalRepository): Response
    {
        $category = $categorieAnimalRepository->getAllFamilies($idCategory);

        return $this->render('families/index.html.twig', [
            'families' => $category->getFamilleAnimals(),
            'categoryName' => $category->getNomCategorie(),
            'category' => true,
        ]);
    }

    #[Route('/families/', name: 'app_families_showall')]
    public function showAll(FamilleAnimalRepository $familleAnimalRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');

        return $this->render('families/index.html.twig', [
            'families' => $familleAnimalRepository->getAllFamiliesWithPicture($search),
            'category' => false,
            'search' => $search,
        ]);
    }
}
