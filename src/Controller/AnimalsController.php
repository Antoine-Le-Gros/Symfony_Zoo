<?php

namespace App\Controller;

use App\Repository\EspeceRepository;
use App\Repository\FamilleAnimalRepository;
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
            'animaux' => $espece->getAnimals(),
            'especeName' => $espece->getLibEspece(),
        ]);
    }
}
