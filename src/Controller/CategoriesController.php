<?php

namespace App\Controller;

use App\Repository\CategorieAnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(CategorieAnimalRepository $categoryAnimalRepository): Response
    {
        return $this->render('categories/index.html.twig', [
            'categories' => $categoryAnimalRepository->getAllCategories(),
        ]);
    }
}
