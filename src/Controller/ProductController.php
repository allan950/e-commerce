<?php

namespace App\Controller;

use App\Entity\Product;
use App\Repository\ProductRepository;
use App\Service\ManageCart;
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

    #[Route('/product/{id<[0-9]+>}', name: 'app_product')]
    public function retrieveProduct(Product $product): Response {

        return $this->render('product/index.html.twig', [
            "product" => $product,
        ]);
    }

    #[Route('/product/{id<[0-9]+>}/add-to-cart', name: 'app_add_product_to_cart')]
    public function addProductToCart(Product $product, Request $req, $id) {
        //dd($id);
        $session = $req->getSession();
        //$session->remove("cart");        
        
        if ($session->get("cart")) {
            $cart = $session->get("cart");
        }
        else {
            $cart = new ManageCart();
        }
        //$currentCart = $cart->getCart();
        $item = [
            "id" => $product->getId(),
            "name" => $product->getName(),
            "price" => $product->getPrice(),
            "quantity" => 1,
        ];

        $cart->addItemToCart($item);
        $session->set("cart", $cart);
        
        return $this->redirect("/product/product/".$id);
    }
}
