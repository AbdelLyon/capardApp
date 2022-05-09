<?php

namespace App\Controller\Shop;

use App\Entity\Product;
use App\Repository\CategoryRepository;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/products/{cat}/{subcat}', name: 'products')]
    public function index(ProductRepository $repProduct, CategoryRepository $repCat, string $cat, string $subcat): Response
    {

        $products = array_filter(
            $repProduct->findAll(),
            fn ($product) =>
            $product->getCategory()->getName() === $cat && $product->getSubcategory()->getName() === $subcat
        );


        return $this->render('shop/product/index.html.twig', [
            'products' => $products,
            'categories' => $repCat->findAll()
        ]);
    }


    #[Route('/products/{id}', name: 'product_readOne')]
    public function readOne(Product $product,  CategoryRepository $repCat): Response
    {


        return $this->render('shop/product/readOne.html.twig', [
            'product' => $product,
            'categories' => $repCat->findAll()

        ]);
    }
}
