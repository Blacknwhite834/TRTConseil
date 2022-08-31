<?php

// src/EventListener/UserChangedNotifier.php
namespace App\EventListener;

use App\Entity\Annonce;
use App\Entity\Candidature;
use App\Entity\User;
use Doctrine\Persistence\Event\LifecycleEventArgs;
use phpDocumentor\Reflection\Types\True_;
use Symfony\Component\Mailer\MailerInterface;
use Symfony\Component\Mime\Email;

class MailEvent
{
    // the entity listener methods receive two arguments:
    // the entity instance and the lifecycle event
    public function preUpdate(Candidature $candidature, Annonce $annonce, MailerInterface $mailer, LifecycleEventArgs $event): void
    {
        $change = $event->getEntityChangeSet();

        if ($change instanceof Candidature and $candidature->getIsVerified()) {
            $email = (new Email())
                ->from('trtconseilexample@gmail.com')
                ->to($annonce->getEmail())
                ->subject('Vous avez un nouveau candidat !')
                ->text("{$candidature->getNom()} {$candidature->getPrenom()} a postulé à votre annonce, vous trouverez son CV en pièce jointe !")
                ->attachFromPath("public/uploads/images/{$candidature->getCv()}");
            ;
            $mailer->send($email);
        }
    }
}
