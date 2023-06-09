<?php

namespace App\Controller\Front;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use App\Entity\Category;
use App\Repository\CategoryRepository;
use App\Form\CategoryType;
use App\Form\CategoryUpdateType;

class CategoryController extends AbstractController
{
    #[Route('/category', name: 'app_category')]
    public function index(CategoryRepository $categoryRepository): Response
    {
        $categories = $categoryRepository->findAll();
        return $this->render('front/category/index.html.twig', [
            'categories' => $categories
        ]);
    }

    #[Route('/category/new', name: 'app_category_new')]
    public function new(Request $request, CategoryRepository $categoryRepository): Response
    {
        $category = new Category();
        $form = $this->createForm(CategoryUpdateType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $category->setIsActive(false);
            $category->setOwner($this->getUser());
            $category->setIsActive(false);

            $categoryRepository->save($category, true);
            return $this->redirectToRoute('front_app_category');
        }

        return $this->renderForm('front/category/new.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/category/{id}', name: 'app_category_show')]
    public function show(Category $category): Response
    {
        return $this->render('front/category/show.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/category/edit/{id}', name: 'app_category_edit')]
    public function edit(Category $category, Request $request, CategoryRepository $categoryRepository): Response
    {
        $form = $this->createForm(CategoryUpdateType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            if($categoryRepository->findBy(['name' => $category->getName()])){
                $this->addFlash('error', 'Cette catégorie existe déjà');
                return $this->redirectToRoute('front_app_category', [], Response::HTTP_SEE_OTHER);
            }

            $category->setIsActive(false);
            $categoryRepository->save($category, true);

            return $this->redirectToRoute('front_app_category', [], Response::HTTP_SEE_OTHER);
        }

        return $this->renderForm('front/category/edit.html.twig', [
            'category' => $category,
            'form' => $form,
        ]);
    }

    #[Route('/category/enable/{id}', name: 'app_category_enable')]
    #[Security("is_granted('ROLE_ADMIN')")]
    public function enable(Category $category, Request $request, CategoryRepository $categoryRepository): Response
    {
        $category->setIsActive(true);
        $categoryRepository->save($category, true);
        $this->addFlash('success', 'Catégorie activée');

        return $this->redirectToRoute('front_app_category', [], Response::HTTP_SEE_OTHER);
    }
}
