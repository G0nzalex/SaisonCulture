<?php

namespace App\Controller;
use App\Form\CategoryFormType;
use App\Entity\Category;
use App\Entity\Products;
use App\Entity\User;
use App\Form\RegistrationFormType;
use App\Repository\CategoryRepository;
use App\Repository\ProductsRepository;
use App\Repository\UserRepository;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\File\Exception\FileException;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\String\Slugger\SluggerInterface;

#[Route('/admin')]
class AdminController extends AbstractController
{
    #[Route('/dashboard', name: 'app_dashboard')]
    public function dashboard(): Response
    {
        return $this->render('admin/admin.html.twig', [
            'controller_name' => 'AdminController',
        ]);
    }
    #[Route('/category', name: 'app_category_index', methods: ['GET'])]
    public function indexcategory(CategoryRepository $categoryRepository): Response
    {
        return $this->render('admin/categories.html.twig', [
            'categoryForm' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/category/new', name: 'app_category_new', methods: ['GET', 'POST'])]
    public function newcategory(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();

        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setCreatedAt(new \DateTimeImmutable());
            $categoryRepository->add($category);
            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/newcategory.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/admin/category/{id}', name: 'app_category_show', methods: ['GET'])]
    public function showcategory(Category $category): Response
    {
        return $this->render('admin/showcategory.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/admin/category/{id}/edit', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function editcategory(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryFormType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $categoryRepository->add($category);
            return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/editcategory.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('admin/category/{id}', name: 'app_category_delete', methods: ['POST'])]
    public function deletecategory(Request $request, Category $category, CategoryRepository $categoryRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$category->getId(), $request->request->get('_token'))) {
            $categoryRepository->remove($category);
        }

        return $this->redirectToRoute('app_category_index', [], Response::HTTP_SEE_OTHER);
    }

    #[Route('/users', name: 'app_users_index', methods: ['GET'])]
    public function userindex(UserRepository $userRepository): Response
    {
        return $this->render('admin/utilisateur.html.twig', [
            'UserForm' => $userRepository->findAll(),
        ]);
    }

    #[Route('/users/newusers', name: 'app_users_new', methods: ['GET', 'POST'])]
    public function newuser(Request $request, UserRepository $userRepository): Response
    {
        $users = new User();

        $form = $this->createForm(RegistrationFormType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $users->setCreatedAt(new \DateTimeImmutable());
            $userRepository->add($users);
            return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/newusers.html.twig', [
            'users' => $users,
            'form' => $form,
        ]);
    }

    #[Route('/admin/users/{id}', name: 'app_users_show', methods: ['GET'])]
    public function showusers(User $users): Response
    {
        return $this->render('admin/showusers.html.twig', [
            'users' => $users,
        ]);
    }

    #[Route('admin/users/{id}', name: 'app_users_delete', methods: ['POST'])]
    public function deleteusers(Request $request, User $users, UserRepository $userRepository): Response
    {
        if ($this->isCsrfTokenValid('delete'.$users->getId(), $request->request->get('_token'))) {
            $userRepository->remove($users);
        }

        return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
    }

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
            $product->setActive(true);
            $product->setCreatedat(new \DateTimeImmutable());

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
            $productsRepository->add($product);
            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);


            // ... persist the $product variable or any other work
        }

        return $this->renderForm('producer/new.html.twig', [
            'form' => $form,
            'product' => $product,
        ]);
    }
    #[Route('/product/{id}', name: 'app_producer_show', methods: ['GET'])]
    public function show(Products $product): Response
    {
        return $this->render('producer/show.html.twig', [
            'product' => $product,
        ]);
    }
    #[Route('/product/{id}/edit', name: 'app_product_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Products $product, ProductsRepository $productsRepository): Response
    {
        $form = $this->createForm(AddProductFormType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $productsRepository->add($product);
            return $this->redirectToRoute('app_product_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('producer/edit.html.twig', [
            'product' => $product,
            'form' => $form,
        ]);
    }

}
