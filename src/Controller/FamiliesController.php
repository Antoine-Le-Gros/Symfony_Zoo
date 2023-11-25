<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class FamiliesController extends AbstractController
{
    #[Route('/families', name: 'app_families')]
    public function index(): Response
    {
        return $this->render('families/index.html.twig', [
            'controller_name' => 'FamiliesController',
        ]);
    }
}
