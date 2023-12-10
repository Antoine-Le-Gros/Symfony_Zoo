<?php

namespace App\Controller;

use App\Entity\Evenement;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class EvenementController extends AbstractController
{
    #[Route('/evenement/{id}/update', requirements: ['id' => '\id'])]
    public function update(Evenement $event): Response
    {
        return $this->render('evenement/update.html.twig', [
            'event' => $event,
        ]);
    }
}
