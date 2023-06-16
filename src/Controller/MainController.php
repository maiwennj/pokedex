<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class MainController extends AbstractController
{
    #[Route(['/main','/','home'], name: 'app_main')]
    public function index(): Response
    {
        return $this->render('main/index.html.twig', [
            'trainer_name' => 'Bleunwenn',
        ]);
    }

    #[Route(['/about-us'], name: 'app_about_us')]
    public function aboutUs(): Response
    {
        return $this->render('main/about-us.html.twig');
    }
}
