<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class AdminController extends AbstractController
{
    #[Route('admin/users', name: 'users')]
    public function gestionUtilisateurs(): Response
    {
        return $this->render('admin/utilisateur.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('admin/categories', name: 'categories')]
    public function gestionCategories(): Response
    {
        return $this->render('admin/categories.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('admin/products', name: 'products')]
    public function gestionProduits(): Response
    {
        return $this->render('admin/produits.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }

}
