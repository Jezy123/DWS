<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use App\Service\ProductsService;
use Doctrine\Persistence\ManagerRegistry;

class ProductController extends AbstractController
{
    #[Route('/product', name: 'product')]
public function index(ProductsService $productsService): Response
{
    $products = $productsService->getProducts();
    return $this->render('product/products.html.twig', compact('products'));
}

}
