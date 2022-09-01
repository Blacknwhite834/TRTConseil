<?php

// src/EventListener/UserChangedNotifier.php
namespace App\EventListener;


use App\Entity\Candidature;
use App\Entity\Annonce;
use App\Entity\User;
use App\Repository\AnnonceRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use Symfony\Component\HttpFoundation\Request;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Component\HttpFoundation\RequestStack;
use Symfony\Component\Mailer\Mailer;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;
use Symfony\Component\Routing\Annotation\Route;

class MailEvent
{
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event

    private EntityManagerInterface $entityManager;

    public function postUpdate(Candidature $candidature, LifecycleEventArgs $event)
    {
        $request = $this->requestStack->getCurrentRequest();






        if ($candidature->getIsVerified()) {
        $email = (new Email())
        ->from('trtconseilexample@gmail.com')
        ->to($candidature->getAnnonce()->getEmail()) // get the email of the annnonce
        ->subject('Vous avez un nouveau candidat !')
        ->text("{$candidature->getNom()} {$candidature->getPrenom()} a postulé à votre annonce, vous trouverez son CV en pièce jointe !")
        ->attachFromPath("public/uploads/images/{$candidature->getCv()}");
    ;
    $this->mailer->send($email);
        }




    }

    public function __construct(
        private readonly MailerInterface $mailer,
        private readonly RequestStack $requestStack,
    ){

    }



}
