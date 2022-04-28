<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomepageController extends AbstractController
{
    #[Route('/', name: 'app_homepage')]
    public function homepage(): Response
    {
        return $this->render('homepage/accueil.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/apropos', name: 'app_apropos')]
    public function apropos(): Response
    {
        return $this->render('homepage/apropos.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/cgu', name: 'app_cgu')]
    public function cgu(): Response
    {
        return $this->render('homepage/cgu.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/mentions', name: 'app_mentions')]
    public function mentions(): Response
    {
        return $this->render('homepage/mentions.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/presentation', name: 'app_presentation')]
    public function presentation(): Response
    {
        return $this->render('homepage/presentation.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
    #[Route('/rgpd', name: 'app_rgpd')]
    public function rgpd(): Response
    {
        return $this->render('homepage/rgpd.html.twig', [
            'controller_name' => 'HomepageController',
        ]);
    }
}
