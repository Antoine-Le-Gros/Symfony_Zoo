<?php

namespace App\Controller\Admin;

use App\Entity\Animal;
use App\Entity\AnimalCategory;
use App\Entity\AnimalDiet;
use App\Entity\Category;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('Sae3 01');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linkToDashboard('Dashboard', 'fa fa-home');
        yield MenuItem::linkToCrud('Régimes', 'fas fa-list', AnimalDiet::class);
        yield MenuItem::linkToCrud('Catégories', 'fas fa-list', AnimalCategory::class);
        yield MenuItem::linkToCrud('Animaux', 'fas fa-list', Animal::class);
        // yield MenuItem::linkToCrud('ajouter pour chaque crud', 'fas fa-list', EntityClass::class);
    }
}
