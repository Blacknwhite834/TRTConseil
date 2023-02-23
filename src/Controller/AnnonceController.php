<?php

namespace App\Controller;

use App\Entity\Candidature;
use App\Entity\ProfileCandidat;
use App\Entity\Annonce;
use App\Form\AnnonceType;
use App\Repository\AnnonceRepository;
use App\Repository\ProfileCandidatRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Validator\Context\ExecutionContextInterface;

#[Route('/annonce')]
class AnnonceController extends AbstractController
{

    #[Route('/', name: 'app_annonce_index', methods: ['GET'])]
    public function index(AnnonceRepository $annonceRepository, Request $request): Response
    {
        if ($this->getUser()->getIsApproved() == false or $this->getUser()->isIsVerified() == false) {
            throw $this->createAccessDeniedException('not approved');
        }

        $search2 = $annonceRepository->findOneBySomeField2(
            $request->query->get('q')
        );
        $email = $this->getUser()->getEmail();

            return $this->render('annonce/index.html.twig', [
                'annonces' => $search2,
                'email' => $email,
            ]);

    }

    #[Route('/new', name: 'app_annonce_new', methods: ['GET', 'POST'])]
    public function new(Request $request, AnnonceRepository $annonceRepository, EntityManagerInterface $entityManager): Response
    {
        if ($this->getUser()->getIsApproved() == false or $this->getUser()->isIsVerified() == false) {
            throw $this->createAccessDeniedException('not approved');
        }
        $annonce = new Annonce();
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);
        $email = $this->getUser()->getEmail();

        if ($form->isSubmitted() && $form->isValid()) {
            $annonce->setEmail($email);
            $annonce->setUser($this->getUser());
            $entityManager->persist($annonce);
            $entityManager->flush();
            return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonce/new.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
            'email' => $email,
        ]);
    }
    #[Route('/{id}/edit', name: 'app_annonce_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Annonce $annonce, AnnonceRepository $annonceRepository): Response
    {
        if ($this->getUser()->getIsApproved() == false or $this->getUser()->isIsVerified() == false) {
            throw $this->createAccessDeniedException('not approved');
        }
        $form = $this->createForm(AnnonceType::class, $annonce);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $annonceRepository->add($annonce, true);

            return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('annonce/edit.html.twig', [
            'annonce' => $annonce,
            'form' => $form,
        ]);
    }

    #[Route('/{id}', name: 'app_annonce_show', methods: ['GET'])]
    public function show(Annonce $annonce, ManagerRegistry $doctrine): Response
    {
        if ($this->getUser()->getIsApproved() == false or $this->getUser()->isIsVerified() == false) {
            throw $this->createAccessDeniedException('not approved');
        }

        $email = $this->getUser()->getEmail();

          //  $candidats = $doctrine->getRepository(Candidature::class);
           // $listCandidats = $candidats->findAll();

        $candidatsVerified = $doctrine->getRepository(Candidature::class)->findBy(['is_verified' => true]);


        if (!$annonce->getIsVerified()) {
            throw $this->createNotFoundException();
        }
        return $this->render('annonce/show.html.twig', [
            'annonce' => $annonce,
            'candidats' => $candidatsVerified,
            'email' => $email,
        ]);
    }


    #[Route('/{id}', name: 'app_annonce_delete', methods: ['POST'])]
    public function delete(Request $request, Annonce $annonce, AnnonceRepository $annonceRepository): Response
    {
        if ($this->getUser()->getIsApproved() == false or $this->getUser()->isIsVerified() == false) {
            throw $this->createAccessDeniedException('not approved');
        }
        if ($this->isCsrfTokenValid('delete'.$annonce->getId(), $request->request->get('_token'))) {
            $annonceRepository->remove($annonce, true);
        }

        return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
    }


}
