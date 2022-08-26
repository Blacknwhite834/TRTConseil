<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class WaitController extends AbstractController
{
    #[Route('/wait', name: 'app_wait')]
    public function index(): Response
    {

        return $this->render('wait/index.html.twig', [
            'controller_name' => 'WaitController',
        ]);
    }
}
