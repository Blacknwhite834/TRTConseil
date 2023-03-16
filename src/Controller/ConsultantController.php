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


class ConsultantController extends AbstractController
{
    #[Route('/consultant', name: 'app_consultant_new', methods: ['GET', 'POST'])]
    public function new(ManagerRegistry $doctrine): Response
    {

       if (!$this->getUser()->getIsApproved() or !$this->getUser()->isIsVerified()) {
            throw $this->createAccessDeniedException('not approved');
        }

      

       $email = $this->getUser()->getEmail();


        return $this->render('consultant/index.html.twig', [
           // 'email' => $email,
        ]);
    }
}
