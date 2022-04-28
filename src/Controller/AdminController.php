<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/gestionutilisateurs', name: 'gestionutilisateurs')]
    public function gestionUtilisateurs(): Response
    {
        return $this->render('admin/utilisateur.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/gestioncategories', name: 'gestioncategories')]
    public function gestionCategories(): Response
    {
        return $this->render('admin/categories.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/gestionproduits', name: 'gestionproduits')]
    public function gestionProduits(): Response
    {
        return $this->render('admin/produits.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

}
