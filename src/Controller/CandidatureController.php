<?php

namespace App\Controller;

use App\Entity\Annonce;
use App\Entity\Candidature;
use App\Entity\ProfileCandidat;
use App\Repository\ProfileCandidatRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ManagerRegistry;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Address;
use Symfony\Component\PropertyAccess\PropertyAccess;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Mime\Email;
use Symfony\Config\DoctrineConfig;

class CandidatureController extends AbstractController
{
    #[Route('/candidature', name: 'app_candidature', methods: ['GET', 'POST'])]
    public function index(EntityManagerInterface $entityManager, ManagerRegistry $doctrine, Request $request, MailerInterface $mailer): Response
    {
        if ($this->getUser()->getIsApproved() == false or $this->getUser()->isIsVerified() == false) {
            throw $this->createAccessDeniedException('not approved');
        }
        $candidature = new Candidature();

        $candidatRepo = $doctrine->getRepository(ProfileCandidat::class,); // access to the repository of ProfileCandidat
        $candidatNom = $candidatRepo->findOneBy([
            'email_adress' => $this->getUser()->getEmail()
        ]);

        $annonce = $entityManager->getRepository(Annonce::class)->findOneBy([
            'id' => $request->get('id')
        ]);


        //dd($candidatNom->getNom()); // display the name of the specific ProfileCandidat with the id

        $candidature->setNom($candidatNom->getNom());    // set the name of the ProfileCandidat in the Candidature
        $candidature->setPrenom($candidatNom->getPrenom()); // set the lastname of the ProfileCandidat in the Candidature
        $candidature->setCv($candidatNom->getCV()); // set the cv of the ProfileCandidat in the Candidature
        $candidature->setAnnonce($annonce); // set the annonce_id in the Candidature

        $entityManager->persist($candidature);
        $entityManager->flush();

        if ($candidature->getIsVerified()) {
            $email = (new Email())
                ->from('trtconseilexample@gmail.com')
                ->to($annonce->getEmail())
                ->subject('Vous avez un nouveau candidat !')
                ->text("{$candidature->getNom()} {$candidature->getPrenom()} a postulé à votre annonce, vous trouverez son CV en pièce jointe !")
                ->attachFromPath("public/uploads/images/{$candidature->getCv()}");
            ;
            $mailer->send($email);
        }

        return $this->redirectToRoute('app_annonce_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/envoi-email', name: 'envoi-email', methods: ['GET', 'POST'])]
    public function sendEmail(MailerInterface $mailer, Candidature $candidature, Annonce $annonce): Response
    {
       if ($candidature->getIsVerified()) {
            $email = (new Email())
                ->from('trtconseilexample@gmail.com')
                ->to($annonce->getEmail())
                ->subject('Vous avez un nouveau candidat !')
                ->text("{$candidature->getNom()} {$candidature->getPrenom()} a postulé à votre annonce, vous trouverez son CV en pièce jointe !")
                ->attachFromPath("public/uploads/images/{$candidature->getCv()}");
            ;
            $mailer->send($email);
       }



        return new Response("Email envoyé avec succès");
    }

}
