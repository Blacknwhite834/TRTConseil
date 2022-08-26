<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\ProfileRecruteur;
use App\Entity\User;
use App\Form\CompleteRecruteurType;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectManager;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CompleteProfileRecruteurController extends AbstractController
{
    #[Route('/complete/profile/recruteur', name: 'app_complete_profile_recruteur', methods: ['GET', 'POST'])]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()->isIsVerified() == false) {
            throw $this->createAccessDeniedException('not approved');
        }

    //    $profileId = $entityManager->getRepository(ProfileRecruteur::class)->findOneBy([
     //       'id' => $request->get('id')
     //   ]);


        $profile = new ProfileRecruteur();
        $form = $this->createForm(CompleteRecruteurType::class, $profile);
        $form->handleRequest($request);


        if ($form->isSubmitted() && $form->isValid()) {
            $profile->setEmailAdress($this->getUser()->getEmail());
            $this->getUser()->setRoles(['ROLE_RECRUTEUR']);
            $entityManager->persist($profile);
            $entityManager->flush();

            return $this->redirectToRoute('app_wait');
        }



        return $this->render('complete_profile_recruteur/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }








}
