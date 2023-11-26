<?php

namespace App\Controller;

use App\Entity\FamilleAnimal;
use App\Repository\CategorieAnimalRepository;
use App\Repository\FamilleAnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
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
    public function showAll(FamilleAnimalRepository $familleAnimalRepository): Response
    {
        return $this->render('families/index.html.twig', [
            'species' => $familleAnimalRepository->getAllFamiliesWithPicture(),
            'category' => false,
        ]);
    }
}
