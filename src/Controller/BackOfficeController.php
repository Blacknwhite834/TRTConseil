<?php

namespace App\Controller;

use App\Repository\AnnonceRepository;
use App\Repository\CandidatureRepository;
use App\Repository\ProfileCandidatRepository;
use App\Repository\ProfileRecruteurRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Mapping\Id;

use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/back-office')]
class BackOfficeController extends AbstractController
{
    #[Route('/', name: 'app_back_office')]
    public function index(UserRepository $repository, AnnonceRepository $annonceRepository, CandidatureRepository $candidatureRepository): Response
    {


        $email = $this->getUser()->getEmail();
        return $this->render('back_office/index.html.twig', [
            'controller_name' => 'BackOfficeController',
            'annonce' => $annonceRepository->findAll(),
            'email' => $email,
            'user' => $repository->findAll(),
            'candidature' => $candidatureRepository->findAll(),
        ]);
    }

    #[Route('/utilisateurs', name: 'app_back_office_utilisateurs')]
    public function users(UserRepository $repository, AnnonceRepository $annonceRepository, CandidatureRepository $candidatureRepository,Request $request): Response
    {
        $search = $repository->findOneBySomeField(
            $request->query->get('q')
        );

        $email = $this->getUser()->getEmail();
        return $this->render('back_office/utilisateurs.html.twig', [
            'controller_name' => 'BackOfficeController',

            'email' => $email,
            'user' => $search,
        ]);
    }

    #[Route('/annonces', name: 'app_back_office_annonces')]
    public function annonces(UserRepository $repository, AnnonceRepository $annonceRepository, CandidatureRepository $candidatureRepository, Request $request): Response
    {

        $search2 = $annonceRepository->findOneBySomeField(
            $request->query->get('p')
        );


        $email = $this->getUser()->getEmail();
        return $this->render('back_office/annonces.html.twig', [
            'controller_name' => 'BackOfficeController',

            'email' => $email,
            'annonce' => $search2,
        ]);
    }

    #[Route('/candidatures', name: 'app_back_office_candidatures')]
    public function candidatures(UserRepository $repository, AnnonceRepository $annonceRepository, CandidatureRepository $candidatureRepository, Request $request): Response
    {
        $search3 = $candidatureRepository->findOneBySomeField(
            $request->query->get('q')
        );

        $email = $this->getUser()->getEmail();
        return $this->render('back_office/candidatures.html.twig', [
            'controller_name' => 'BackOfficeController',

            'email' => $email,
            'candidature' => $search3,
        ]);
    }

    #[Route('/{id}/activate-permission1', name: 'app_back_office_permission2', methods: ['GET', 'POST'])]
    public function permission(UserRepository $repository, ProfileCandidatRepository $candidatRepository, $id, EntityManagerInterface $entityManager): Response
    {

        $user = $repository->find($id);
        $user->setIsVerified(!(($user->isIsVerified() == true)));
        $entityManager->persist($user);
        $entityManager->flush();

        $email = $this->getUser()->getEmail();
        return $this->redirectToRoute('app_back_office', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/activate-permission2', name: 'app_back_office_permission2', methods: ['GET', 'POST'])]
    public function permission2(UserRepository $repository, ProfileCandidatRepository $candidatRepository, $id, EntityManagerInterface $entityManager): Response
    {

        $user = $repository->find($id);
        $user->setIsApproved(!(($user->getIsApproved() == true)));
        $entityManager->persist($user);
        $entityManager->flush();

        $email = $this->getUser()->getEmail();
        return $this->redirectToRoute('app_back_office', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/activate-permission3', name: 'app_back_office_permission3', methods: ['GET', 'POST'])]
    public function permission3(UserRepository $repository, AnnonceRepository $annonceRepository, $id, EntityManagerInterface $entityManager): Response
    {

        $annonce = $annonceRepository->find($id);
        $annonce->setIsVerified(!(($annonce->getIsVerified() == true)));
        $entityManager->persist($annonce);
        $entityManager->flush();

        $email = $this->getUser()->getEmail();
        return $this->redirectToRoute('app_back_office', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/{id}/activate-permission4', name: 'app_back_office_permission4', methods: ['GET', 'POST'])]
    public function permission4(UserRepository $repository, CandidatureRepository $candidatureRepository, $id, EntityManagerInterface $entityManager): Response
    {

        $candidature = $candidatureRepository->find($id);
        $candidature->setIsVerified(!(($candidature->getIsVerified() == true)));
        $entityManager->persist($candidature);
        $entityManager->flush();

        $email = $this->getUser()->getEmail();
        return $this->redirectToRoute('app_back_office', [], Response::HTTP_SEE_OTHER);
    }



    #[Route('/show/{id}', name: 'app_back_office_show', methods: ['GET', 'POST'])]
    public function show(UserRepository $repository, CandidatureRepository $candidatureRepository, ProfileCandidatRepository $candidatRepository, $id, ProfileRecruteurRepository $recruteurRepository, AnnonceRepository $annonceRepository): Response
    {




        $email = $this->getUser()->getEmail();
        return $this->render('back_office/show.html.twig', [
            'controller_name' => 'BackOfficeController',
            'email' => $email,
            'candidature' => $candidatureRepository->findBy(['user' => $id]),
            'annonces' => $annonceRepository->findBy(['user' => $id]),
            'candidat' => $candidatRepository->findBy(['user' => $id]),
            'recruteur' => $recruteurRepository->findBy(['user' => $id]),

        ]);
    }
}
