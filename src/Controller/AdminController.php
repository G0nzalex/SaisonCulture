<?php

namespace App\Controller;
use App\Form\CategoryFormType;
use App\Entity\Category;
use App\Entity\User;
use App\Repository\CategoryRepository;
use App\Repository\UserRepository;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
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
    public function index(CategoryRepository $categoryRepository): Response
    {
        return $this->render('admin/categories.html.twig', [
            'categoryForm' => $categoryRepository->findAll(),
        ]);
    }

    #[Route('/category/new', name: 'app_category_new', methods: ['GET', 'POST'])]
    public function new(Request $request, CategoryRepository $categoryRepository): Response
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
    public function show(Category $category): Response
    {
        return $this->render('admin/showcategory.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/admin/category/{id}/edit', name: 'app_category_edit', methods: ['GET', 'POST'])]
    public function edit(Request $request, Category $category, CategoryRepository $categoryRepository): Response
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
    public function delete(Request $request, Category $category, CategoryRepository $categoryRepository): Response
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

    #[Route('/admin/users/{id}/edit', name: 'app_users_edit', methods: ['GET', 'POST'])]
    public function editusers(Request $request, User $users, UserRepository $usersRepository): Response
    {
        $form = $this->createForm(RepositoryFormType::class, $users);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $usersRepository->add($users);
            return $this->redirectToRoute('app_users_index', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('admin/editusers.html.twig', [
            'users' => $users,
            'form' => $form,
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

}
