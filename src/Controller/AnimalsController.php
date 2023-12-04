<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\EspeceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalsController extends AbstractController
{
    #[Route('/animals/{idEspece}', name: 'app_animals', requirements: ['idEspece' => '\d+'])]
    public function index(int $idEspece, EspeceRepository $especeRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');
        $espece = $especeRepository->getAllAnimals($idEspece, $search);

        return $this->render('animals/index.html.twig', [
            'animaux' => $espece,
            'especeName' => $especeRepository->find($idEspece)->getLibEspece(),
            'espece' => true,
            'search' => $search,
            'idEspece' => $idEspece,
        ]);
    }

    #[Route('/animals/', name: 'app_animals_showall')]
    public function showAll(AnimalRepository $animalRepository, Request $request): Response
    {
        $search = $request->query->get('search', '');

        return $this->render('animals/index.html.twig', [
            'animaux' => $animalRepository->getAllAnimalsWithPicture($search),
            'espece' => false,
            'search' => $search,
        ]);
    }
}
