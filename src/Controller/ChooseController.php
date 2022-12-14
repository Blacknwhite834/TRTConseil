<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ChooseController extends AbstractController
{
    #[Route('/choose', name: 'app_choose')]
    public function index(): Response
    {
        if ($this->getUser()->isIsVerified() == false) {
            throw $this->createAccessDeniedException('not approved');
        }
        return $this->render('choose/index.html.twig', [
            'controller_name' => 'ChooseController',
        ]);
    }
}
