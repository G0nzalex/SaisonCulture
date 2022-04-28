<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProducerController extends AbstractController
{
    #[Route('/ajoutdeproduit', name: 'app_ajout')]
    public function ajout(): Response
    {
        return $this->render('producer/ajout.html.twig', [
            'controller_name' => 'ProducerController',
        ]);
    }
    #[Route('/modificationdeproduit', name: 'app_modification')]
    public function modification(): Response
    {
        return $this->render('producer/modification.html.twig', [
            'controller_name' => 'ProducerController',
        ]);
    }
    #[Route('/modificationcompte', name: 'app_modificationcompte')]
    public function modificationCompte(): Response
    {
        return $this->render('producer/modification.html.twig', [
            'controller_name' => 'ProducerController',
        ]);
    }
    #[Route('/suppression', name: 'app_suppression')]
    public function suppression(): Response
    {
        return $this->render('producer/suppression.html.twig', [
            'controller_name' => 'ProducerController',
        ]);
    }
}
