<?php

namespace App\Controller;

use App\Entity\ProfileRecruteur;
use App\Form\CompleteRecruteurType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompleteProfileRecruteurController extends AbstractController
{
    #[Route('/complete/profile/recruteur', name: 'app_complete_profile_recruteur')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        $profile = new ProfileRecruteur();
        $form = $this->createForm(CompleteRecruteurType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile->setEmailAdress($this->getUser()->getEmail());
            $entityManager->persist($profile);
            $entityManager->flush();
            return $this->redirectToRoute('app_home_page');
        }


        return $this->render('complete_profile_recruteur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
