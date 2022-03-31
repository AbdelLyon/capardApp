<?php

namespace App\Controller\Shop;

use App\Repository\CategoryRepository;
use App\Repository\SubcategoryRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class HomeController extends AbstractController
{

    #[Route('/home', name: 'home')]
    public function home(CategoryRepository $rep): Response
    {
        return $this->render('shop/home/index.html.twig', [
            "categories" => $rep->findBy([])
        ]);
    }

    #[Route('/home/api', name: 'home_api')]
    public function show(SubcategoryRepository $rep): Response
    {
        $subcategoriesArr = array_map(function ($subcategory) {
            return [
                "name" => $subcategory->getName(),
                "categoryId" => $subcategory->getCategory()->getId(),
                "categoryName" => $subcategory->getCategory()->getName()

            ];
        }, $rep->findAll());

        $subcategories = array_reduce($subcategoriesArr, function ($acc, $sub) {
            isset($acc[$sub['categoryName']]) ? $acc[$sub['categoryName']] = [...$acc[$sub['categoryName']], $sub] : $acc[$sub['categoryName']] = [$sub];
            return $acc;
        }, []);

        return $this->json($subcategories);
    }
}
