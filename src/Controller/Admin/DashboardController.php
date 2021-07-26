<?php

namespace App\Controller\Admin;



use App\Entity\CategoryDonnees;
use App\Entity\CategoryNews;
use App\Entity\Documenttype;


use App\Entity\News;
use App\Entity\Partners;
use App\Entity\User;

use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Router\AdminUrlGenerator;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class DashboardController extends AbstractDashboardController
{
    /**
     * @Route("/admin", name="admin")
     */
    public function index(): Response
    {
        // redirect to some CRUD controller
        $routeBuilder = $this->get(AdminUrlGenerator::class);

        return $this->redirect($routeBuilder->setController(DocumenttypeCrudController::class)->generateUrl());
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('ProjetWeb');
    }

    public function configureMenuItems(): iterable
    {
        yield MenuItem::linktoDashboard('Dashboard', 'fa fa-home');

        yield MenuItem::linkToCrud('Categories de données', 'fas fa-list', CategoryDonnees::class);

        // yield MenuItem::linkToCrud('Type de données', 'fas fa-list', DonneesType::class);
        yield MenuItem::linkToCrud('Type de document', 'fas fa-newspaper', Documenttype::class);
        yield MenuItem::linkToCrud('Categories de news', 'fas fa-list', CategoryNews::class);
        yield MenuItem::linkToCrud('Type de news', 'fas fa-newspaper', News::class);
        yield MenuItem::linkToCrud('User', 'fas fa-users', User::class);
        yield MenuItem::linkToCrud('Partenaires','fas fa-users', Partners::class );


    }
}
