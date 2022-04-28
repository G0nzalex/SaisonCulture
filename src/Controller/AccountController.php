<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/jesuisunclient', name: 'app_jesuisunclient')]
    public function inscriptionClient(): Response
    {
        return $this->render('account/inscriptionclient.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    #[Route('/jesuisunproducteur', name: 'app_jesuisunproducteur')]
    public function inscriptionProducteur(): Response
    {
        return $this->render('account/inscriptionproducteur.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    #[Route('/seconnecter', name: 'app_seconnecter')]
    public function login(): Response
    {
        return $this->render('account/connexion.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

}
