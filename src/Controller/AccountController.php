<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AccountController extends AbstractController
{
    #[Route('/account/jesuisunclient', name: 'app_jesuisunclient')]
    public function inscriptionClient(): Response
    {
        return $this->render('account/inscriptionClient.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    #[Route('/account/jesuisunproducteur', name: 'app_jesuisunproducteur')]
    public function inscriptionProducteur(): Response
    {
        return $this->render('account/inscriptionProducteur.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }
    #[Route('/account/seConnecter', name: 'app_seConnecter')]
    public function login(): Response
    {
        return $this->render('account/connexion.html.twig', [
            'controller_name' => 'AccountController',
        ]);
    }

}
