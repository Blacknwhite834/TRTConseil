<?php

namespace App\Controller;

use App\Entity\ProfileCandidat;
use App\Form\CompleteCandidatType;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bridge\Twig\Mime\TemplatedEmail;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mime\Address;
use Symfony\Component\PasswordHasher\Hasher\UserPasswordHasherInterface;
use Symfony\Component\Routing\Annotation\Route;

class CompleteProfileCandidatController extends AbstractController
{
    #[Route('/complete/profile/candidat', name: 'app_complete_profile_candidat')]
    public function index(Request $request, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()->isIsVerified() == false) {
        throw $this->createAccessDeniedException('not approved');
        }
        $profile = new ProfileCandidat();
        $form = $this->createForm(CompleteCandidatType::class, $profile);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $profile->setEmailAdress($this->getUser()->getEmail());
            $file = $form->get('CV')->getData();
            $fileName = md5(uniqid()).'.'.$file->guessExtension();
            $file->move(
                $this->getParameter('upload_directory'),
                $fileName);
            $profile->setCV($fileName);
            $this->getUser()->setRoles(['ROLE_CANDIDAT']);
            $entityManager->persist($profile);
            $entityManager->flush();
            return $this->redirectToRoute('app_wait');
        }




        return $this->render('complete_profile_candidat/index.html.twig', [
            'form' => $form->createView(),
        ]);
    }
}
