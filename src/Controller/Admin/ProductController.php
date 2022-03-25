<?php

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

#[Route('/admin')]
class ProductController extends AbstractController
{
    #[Route('/products', name: 'admin_product_index')]
    public function index(ProductRepository $repo): Response
    {
        return $this->render('admin/product/index.html.twig', [
            'products' => $repo->findAll(),
        ]);
    }

    #[Route('/show/{id}', name: 'admin_product_show')]
    public function show(Product $product): Response
    {
        return $this->render('admin/product/show.html.twig', [
            'product' => $product,
        ]);
    }


    #[Route('/new', name: 'admin_product_new')]
    public function new(Request $request, EntityManagerInterface $em): Response
    {
        $product = new Product;
        $form = $this->createForm(ProductType::class, $product);
        $form->handleRequest($request);

        if ($form->isSubmitted() && $form->isValid()) {
            $product->setCreatedAt(new DateTimeImmutable());
            $em->persist($product);
            $em->flush();
            return $this->redirectToRoute('product');
        }

        return $this->renderForm('admin/product/new.html.twig', [
            'form' => $form,
        ]);
    }
}
