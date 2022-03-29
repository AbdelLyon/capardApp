<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Subcategory;
use App\Form\Admin\SubcategoryType;
use App\Repository\SubcategoryRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/subcategory', name: 'admin_subcategory_')]
class SubcategoryController extends AbstractController
{

    #[Route('/create/{id}', name: 'create', requirements: ['id' => '\d+'], defaults: ['id' => null])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {

        $Subcategory = new Subcategory;
        $form = $this->createForm(SubcategoryType::class, $Subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $Subcategory->setCreatedAt(new DateTimeImmutable());
            $em->persist($Subcategory);
            $em->flush();
            return $this->redirectToRoute('admin_subcategory_readAll');
        }

        return $this->renderForm('admin/subcategory/create.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/all', name: 'readAll')]
    public function readAll(SubcategoryRepository $repo): Response
    {
        return $this->render('admin/subcategory/readAll.html.twig', [
            'subCategories' => $repo->findAll(),
        ]);
    }


    #[Route('/one/{id}', name: 'readOne', requirements: ['id' => '\d+'])]
    public function readOne(Subcategory $Subcategory): Response
    {

        return $this->render('admin/subcategory/readOne.html.twig', [
            'subcategory' => $Subcategory,
        ]);
    }

    #[Route('/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    public function update(Subcategory $Subcategory, Request $request, EntityManagerInterface $em): Response
    {

        $form = $this->createForm(SubcategoryType::class, $Subcategory);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {

            $Subcategory->setCreatedAt(new DateTimeImmutable());
            $em->persist($Subcategory);
            $em->flush();
            return $this->redirectToRoute('admin_subcategory_readAll');
        }

        return $this->renderForm('admin/subcategory/create.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/delete/{id}', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(Subcategory $Subcategory, EntityManagerInterface $em): Response
    {

        $em->remove($Subcategory);
        $em->flush();

        $this->addFlash('success', 'deleted success');

        return $this->redirectToRoute('admin_subcategory_readAll');
    }
}
