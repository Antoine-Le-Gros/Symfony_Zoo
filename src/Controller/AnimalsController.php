<?php

namespace App\Controller;

use App\Repository\AnimalRepository;
use App\Repository\EspeceRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AnimalsController extends AbstractController
{
    #[Route('/animals/{idEspece}', name: 'app_animals', requirements: ['idEspece' => '\d+'])]
    public function index(int $idEspece, EspeceRepository $especeRepository): Response
    {
        $espece = $especeRepository->getAllAnimals($idEspece);

        return $this->render('animals/index.html.twig', [
            'animaux' => $espece,
            'especeName' => $especeRepository->find($idEspece)->getLibEspece(),
            'espece' => true,
        ]);
    }

    #[Route('/animals/', name: 'app_animals_showall')]
    public function showAll(AnimalRepository $animalRepository): Response
    {
        return $this->render('animals/index.html.twig', [
            'animaux' => $animalRepository->getAllAnimalsWithPicture(),
            'espece' => false,
        ]);
    }


}
