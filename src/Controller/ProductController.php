<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/product')]
class ProductController extends AbstractController
{
    #[Route('/list', name: 'app_product_list')]
    public function index(ProductRepository $productRepo): Response
    {
        $products = $productRepo->findAll();

        return $this->render('product-list/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('/list/product/{id<[0-9]+>}', name: 'app_product')]
    public function retrieveProduct(Product $product): Response {

        return $this->render('product/index.html.twig', [
            "product" => $product,
        ]);
    }

    #[Route('/product/add-to-cart', name: 'app_add_product_to_cart')]
    public function addProductToCart() {

    }
}
