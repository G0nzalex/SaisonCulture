<?php

namespace App\Controller;

use App\Entity\User;
use App\Entity\Products;
use App\Repository\ProductsRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\AddProductFormType;
use App\Form\RegistrationForProducerFormType;
use DateTimeImmutable;
use Symfony\Component\String\Slugger\SluggerInterface;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\File\UploadedFile;

#[Route('/producer')]
class ProducerController extends AbstractController
{
    #[Route('/', name: 'app_product_index', methods: ['GET'])]
    public function index(ProductsRepository $productsRepository): Response
    {
        return $this->render('producer/index.html.twig', [
            'products' => $productsRepository->findAll(),
        ]);
    }
    #[Route('/new', name: 'app_product_new')]
    public function ajout(Request $request, SluggerInterface $slugger, ProductsRepository $productsRepository){
        $product = new Products();
        $form = $this->createForm(AddProductFormType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            /** @var UploadedFile $imageFile */
            $imageFile = $form->get('image')->getData();

            // this condition is needed because the 'image' field is not required
            // so the PDF file must be processed only when a file is uploaded
            if ($imageFile) {
                $originalFilename = pathinfo($imageFile->getClientOriginalName(), PATHINFO_FILENAME);
                // this is needed to safely include the file name as part of the URL
                $safeFilename = $slugger->slug($originalFilename);
                $newFilename = $safeFilename.'-'.uniqid().'.'.$imageFile->guessExtension();

                // Move the file to the directory where images are stored
                try {
                    $imageFile->move(
                        $this->getParameter('images_directory'),
                        $newFilename
                    );
                } catch (FileException $e) {
                    // ... handle exception if something happens during file upload
                }

                // updates the 'imageFilename' property to store the PDF file name
                // instead of its contents
                $product->setImg($newFilename);
            }

            // ... persist the $product variable or any other work
        }

        return $this->renderForm('producer/new.html.twig', [
            'form' => $form,
            'product' => $product,
        ]);
    }
    #[Route('/modprod', name: 'app_mod')]
    public function modification(Request $request, EntityManagerInterface $entityManager, Products $product): Response
    {
        
        $form = $this->createForm(AddProductFormType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setModifiedat(new DateTimeImmutable());
            
            $entityManager->persist($product);
            $entityManager->flush();
            

        }
        return $this->render('producer/modification.html.twig.', [
            'modProductForm' => $form->createView(),
        ]);
    }
    #[Route('/editaccount', name: 'app_acc')]
    public function modificationCompte(Request $request, EntityManagerInterface $entityManager, User $user): Response
    {
        $form = $this->createForm(RegistrationForProducerFormType::class, $user);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $user->setModifiedAt(new DateTimeImmutable());
            
            $entityManager->persist($user);
            $entityManager->flush();
            

        }
        return $this->render('producer/modificationCompte.html.twig.', [
            'registrationForProducerForm' => $form->createView(),
        ]);
    }
    #[Route('/supprod', name: 'app_sup', methods: ['POST'])]
    public function delete(Request $request, Products $products, ProductsRepository $productsRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$products->getId(), $request->request->get('_token'))) {
            $productsRepository->remove($products);
        }

        return $this->redirectToRoute('app_beer_index', [], Response::HTTP_SEE_OTHER);
    }
}
