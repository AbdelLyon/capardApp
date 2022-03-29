<?php

declare(strict_types=1);

namespace App\Controller\Admin;

use App\Entity\Product;
use App\Form\Admin\ProductType;
use App\Repository\ProductRepository;
use DateTimeImmutable;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/admin/product', name: 'admin_product_')]
class ProductController extends AbstractController
{


    #[Route('/create/{id}', name: 'create', requirements: ['id' => '\d+'], defaults: ['id' => null])]
    public function create(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product;
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setCreatedAt(new DateTimeImmutable());
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('admin_product_readAll');
        }

        return $this->renderForm('admin/product/create.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/all', name: 'readAll')]
    public function readAll(ProductRepository $repo): Response
    {
        return $this->render('admin/product/readAll.html.twig', [
            'products' => $repo->findAll(),
        ]);
    }

    #[Route('/readOne/{id}', name: 'readOne', requirements: ['id' => '\d+'])]
    public function read(Product $product): Response
    {
        return $this->render('admin/product/readOne.html.twig', [
            'product' => $product,
        ]);
    }


    #[Route('/update/{id}', name: 'update', requirements: ['id' => '\d+'])]
    public function update(Product $product, Request $request, EntityManagerInterface $em): Response
    {
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {






            //essayet de modifier sans persist
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('admin_product_readAll');
        }

        return $this->renderForm('admin/product/create.html.twig', [
            'form' => $form,
        ]);
    }


    #[Route('/delete/{id}', name: 'delete', requirements: ['id' => '\d+'])]
    public function delete(Product $product, EntityManagerInterface $em): Response
    {

        $em->remove($product);
        $em->flush();

        $this->addFlash('success', 'deleted success');

        return $this->redirectToRoute('admin_product_readAll');
    }
}
