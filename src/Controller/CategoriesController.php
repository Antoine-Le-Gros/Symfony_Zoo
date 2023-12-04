<?php

namespace App\Controller;

use App\Repository\CategorieAnimalRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CategoriesController extends AbstractController
{
    #[Route('/categories', name: 'app_categories')]
    public function index(Request $request, CategorieAnimalRepository $categoryAnimalRepository): Response
    {
        $search = $request->query->get('search', '');
        $categories = $categoryAnimalRepository->getAllCategories($search);

        return $this->render('categories/index.html.twig', [
            'categories' => $categories,
            'search' => $search,
        ]);
    }
}
