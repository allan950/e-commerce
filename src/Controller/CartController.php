<?php

namespace App\Controller;

use App\Service\ManageCart;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class CartController extends AbstractController
{
    #[Route('/cart', name: 'app_cart')]
    public function index(ManageCart $cart): Response
    {

        

        $count = $cart->getCount();
        $items = $cart->getCart();
        $total = $cart->getTotal();

        return $this->render('cart/index.html.twig', [
            'cart_total' => $total,
            'cart_products' => $items,
            'cart_count' => $count,
        ]);
    }
}
