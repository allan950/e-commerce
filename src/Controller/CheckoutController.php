<?php

namespace App\Controller;

use App\Entity\Order;
use App\Repository\OrderRepository;
use DateTime;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Core\User\UserInterface;

//\Stripe\Stripe::setApiKey();

class CheckoutController extends AbstractController
{
    #[Route('/checkout', name: 'app_checkout')]
    public function index(Request $req): Response
    {
        $items = $req->getSession()->get("cart")->getCart();

        if ($items && $this->getUser()) {
            \Stripe\Stripe::setApiKey($this->getParameter("api_key_stripe"));

            $order = [];

            foreach($items as $key => $item) {
                $order[$key] = [
                    'price_data' => [
                        'currency' => 'eur',
                        'product_data' => [
                            'name' => $item["name"],
                        ],
                        'unit_amount' => intval($item["price"]) * 100,
                    ],
                    'quantity' => $item["quantity"],
                ];
            }

            //dd($order);

            $session = \Stripe\Checkout\Session::create([
                'line_items' => [$order],
                'mode' => 'payment',
                'success_url' => 'http://localhost:8000/checkout_success',
                'cancel_url' => 'http://localhost:8000/checkout_error',
            ]);

            $req->getSession()->set("order_payment_id", $session->id);

            return $this->redirect($session->url, 303);
        } else {
            return $this->redirect("/");
        }
    }

    #[Route('/checkout_success', name: 'app_checkout_success')]
    public function successfulCheckout(Request $req, OrderRepository $orderRepository)
    {   
        \Stripe\Stripe::setApiKey($this->getParameter("api_key_stripe"));

        $session = \Stripe\Checkout\Session::retrieve($req->getSession()->get("order_payment_id"));

        if ($session) {
            $req->getSession()->set("order_payment_id", "");
        }

        $order = new Order();
        $order->setOrderDate(new DateTime())
        ->setClient($this->getUser())
        ->setTotalPriceHt($session->amount_subtotal/100)
        ->setTotalPriceTtc($session->amount_total/100)
        ->setItems($req->getSession()->get("cart")->getCart())
        ;

        $orderRepository->save($order, true);

        $req->getSession()->set("cart", "");

        return $this->redirect('/');
    }
}
