<?php

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Entity\CategoryData;
use App\Entity\Documenttype;
use App\Entity\TypeData;
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
        yield MenuItem::linkToCrud('Categories', 'fas fa-list', Category::class);
        yield MenuItem::linkToCrud('CategoriesData', 'fas fa-list', CategoryData::class);
        yield MenuItem::linkToCrud('Type de données', 'fas fa-list', TypeData::class);
        yield MenuItem::linkToCrud('Documenttype', 'fas fa-newspaper', Documenttype::class);
        yield MenuItem::linkToCrud('Users', 'fas fa-users', User::class);


    }
}
