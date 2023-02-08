<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class ProductController extends AbstractController
{
    #[Route('/product/list', name: 'app_product_list')]
    public function index(): Response
    {
        $products = "";

        return $this->render('product-list/index.html.twig', [
            'products' => $products,
        ]);
    }

    #[Route('product/list/product/{id<[0-9]+>}', name: 'app_product')]
    public function retrieveProduct(Request $req): Response {

        $id = $req->attributes->get("id");
        dd($id);

        $product = "";

        return $this->render('product/index.html.twig', [
            "product" => $product,
        ]);
    }
}
