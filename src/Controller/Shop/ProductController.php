<?php

namespace App\Controller\Shop;

use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products/{cat}/{subcat}', name: 'products')]
    public function index(ProductRepository $rep, string $cat, string $subcat): Response
    {

        $products = array_filter(
            $rep->findAll(),
            fn ($product) =>
            $product->getCategory()->getName() === $cat && $product->getSubcategory()->getName() === $subcat
        );

        return $this->render('shop/product/index.html.twig', [
            'products' => $products,
        ]);
    }
}
