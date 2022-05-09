<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Category;
use App\Form\Admin\CategoryType;
use App\Repository\CategoryRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/category', name: 'admin_category_')]
class CategoryController extends AbstractController
{

    #[Route('/create/{id}', name: 'create', requirements: ['id' => '\d+'], defaults: ['id' => null])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $category = new Category;
        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $category->setCreatedAt(new DateTimeImmutable());
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('admin_category_readAll');
        }

        return $this->renderForm('admin/category/create.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/all', name: 'readAll')]
    public function readAll(CategoryRepository $repo): Response
    {
        return $this->render('admin/category/readAll.html.twig', [
            'categories' => $repo->findAll(),
        ]);
    }


    #[Route('/one/{id}', name: 'readOne', requirements: ['id' => '\d+'])]
    public function readOne(Category $category): Response
    {

        return $this->render('admin/category/readOne.html.twig', [
            'category' => $category,
        ]);
    }

    #[Route('/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    public function update(Category $category, Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(CategoryType::class, $category);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $category->setCreatedAt(new DateTimeImmutable());
            $em->persist($category);
            $em->flush();
            return $this->redirectToRoute('admin_category_readAll');
        }

        return $this->renderForm('admin/category/create.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/delete/{id}', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(Category $category, EntityManagerInterface $em): Response
    {

        $em->remove($category);
        $em->flush();

        $this->addFlash('success', 'deleted success');

        return $this->redirectToRoute('admin_category_readAll');
    }
}
