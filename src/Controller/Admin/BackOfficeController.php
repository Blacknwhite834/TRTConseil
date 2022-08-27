<?php

namespace App\Controller\Admin;

use App\Entity\Annonce;
use App\Entity\Candidature;
use App\Entity\Consultant;
use App\Entity\ProfileCandidat;
use App\Entity\ProfileRecruteur;
use App\Entity\User;
use EasyCorp\Bundle\EasyAdminBundle\Config\Dashboard;
use EasyCorp\Bundle\EasyAdminBundle\Config\MenuItem;
use EasyCorp\Bundle\EasyAdminBundle\Controller\AbstractDashboardController;
use EasyCorp\Bundle\EasyAdminBundle\Factory\MenuFactory;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class BackOfficeController extends AbstractDashboardController
{
    #[Route('/admin', name: 'admin')]
    public function index(): Response
    {

        // Option 1. You can make your dashboard redirect to some common page of your backend
        //
        //$adminUrlGenerator = $this->container->get(AdminUrlGenerator::class);
        //return $this->redirect($adminUrlGenerator->setController(OneOfYourCrudController::class)->generateUrl());

        // Option 2. You can make your dashboard redirect to different pages depending on the user

        if ($this->getUser()->getRoles(['ROLE_ADMIN'])) {
            return $this->render('admin/dashboardadmin.html.twig');
        }

        // Option 3. You can render some custom template to display a proper dashboard with widgets, etc.
        // (tip: it's easier if your template extends from @EasyAdmin/page/content.html.twig)
        //
        // return $this->render('some/path/my-dashboard.html.twig');
    }

    public function configureDashboard(): Dashboard
    {
        return Dashboard::new()
            ->setTitle('TRT Conseil');
    }

    public function configureMenuItems(): iterable
    {
        return [
        yield MenuItem::linkToRoute('Home', 'fa fa-home', 'app_home_page'),


        yield MenuItem::section('Dashboard :'),
            yield MenuItem::linkToCrud('Users', 'fa-solid fa-user', User::class),
            yield MenuItem::linkToCrud('Consultants', 'fa-solid fa-user', Consultant::class),
        yield MenuItem::linkToCrud('Candidats', 'fa-solid fa-user', ProfileCandidat::class),
        yield MenuItem::linkToCrud('Recruteurs', 'fa-solid fa-user', ProfileRecruteur::class),
            yield MenuItem::linkToCrud('Annonces', 'fa-solid fa-user', Annonce::class),
            yield MenuItem::linkToCrud('Candidatures', 'fa-solid fa-user', Candidature::class)
        ];
    }
}
