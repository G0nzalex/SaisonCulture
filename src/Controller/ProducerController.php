<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProducerController extends AbstractController
{
    #[Route('/producer/ajoutDeProduit', name: 'app_ajout')]
    public function ajout(): Response
    {
        return $this->render('producer/ajout.html.twig', [
            'controller_name' => 'ProducerController',
        ]);
    }
    #[Route('/producer/modificationDeProduit', name: 'app_modification')]
    public function modification(): Response
    {
        return $this->render('producer/modification.html.twig', [
            'controller_name' => 'ProducerController',
        ]);
    }
    #[Route('/producer/modificationCompte', name: 'app_modificationCompte')]
    public function modificationCompte(): Response
    {
        return $this->render('producer/modification.html.twig', [
            'controller_name' => 'ProducerController',
        ]);
    }
    #[Route('/producer/suppression', name: 'app_suppression')]
    public function suppression(): Response
    {
        return $this->render('producer/suppression.html.twig', [
            'controller_name' => 'ProducerController',
        ]);
    }
}
