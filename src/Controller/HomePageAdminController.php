<?php

namespace App\Controller;

use App\Entity\ProfileCandidat;
use App\Entity\ProfileRecruteur;
use App\Repository\AnnonceRepository;
use App\Repository\CandidatureRepository;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\Role\Role;

class HomePageAdminController extends AbstractController
{
    #[Route('/homepage', name: 'app_home_page')]
    public function index(ManagerRegistry $doctrine, AnnonceRepository $annonceRepository, CandidatureRepository $candidatureRepository): Response
    {

       if (!$this->getUser()->getIsApproved() or !$this->getUser()->isIsVerified()) {
            throw $this->createAccessDeniedException('not approved');
        }

       $numberAnnonce = $annonceRepository->count([]);

       $numberCandidature = $candidatureRepository->count([]);



       $email = $this->getUser()->getEmail();


        return $this->render('home_page_admin/index.html.twig', [
            'controller_name' => 'HomePageAdminController',
            'email' => $email,
            'annonces' => $annonceRepository->findBy(
                ['is_verified' => true],
                [],
                4,
                0
            ),
            'numberAnnonce' => $numberAnnonce,
            'numberCandidature' => $numberCandidature,
            'title' => 'Dashboard',
        ]);
    }
}
