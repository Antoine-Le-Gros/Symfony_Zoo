<?php

namespace App\Controller;

use App\Repository\CategorieAnimalRepository;
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
        ]);
    }
}
