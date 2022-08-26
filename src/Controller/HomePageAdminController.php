<?php

namespace App\Controller;

use App\Entity\ProfileCandidat;
use App\Entity\ProfileRecruteur;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Role\Role;

class HomePageAdminController extends AbstractController
{
    #[Route('/homepage', name: 'app_home_page')]
    public function index(ManagerRegistry $doctrine): Response
    {

       if ($this->getUser()->getIsApproved() == false or $this->getUser()->isIsVerified() == false) {
            throw $this->createAccessDeniedException('not approved');
        }

       $email = $this->getUser()->getEmail();

        return $this->render('home_page_admin/index.html.twig', [
            'controller_name' => 'HomePageAdminController',
            'email' => $email,
        ]);
    }
}
