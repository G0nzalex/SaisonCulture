<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('/admin', name: 'app_admin')]
    public function index(): Response
    {
        return $this->render('admin/index.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/gestionUtilisateurs', name: 'gestionUtilisateur')]
    public function gestionUtilisateur(): Response
    {
        return $this->render('admin/utilisateur.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/gestionCategories', name: 'gestionCategories')]
    public function gestionCategorie(): Response
    {
        return $this->render('admin/categories.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/admin/gestionProduits', name: 'gestionProduits')]
    public function gestionProduit(): Response
    {
        return $this->render('admin/produits.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

}
