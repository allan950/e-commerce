<?php

namespace App\Controller;

use App\Entity\User;
use App\Repository\OrderRepository;
use App\Repository\UserRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

#[Route('/dashboard')]
class DashboardController extends AbstractController
{

    public function __construct(private UserRepository $userRepository)
    {

    }

    #[Route('/', name: 'app_dashboard')]
    public function index(): Response
    {


        return $this->render('dashboard/index.html.twig', [
            'controller_name' => 'DashboardController',
        ]);
    }

    #[Route('/info', name: 'app_dashboard_info')]
    public function accessPersonalInfo() {
        $currentUser = $this->userRepository->findOneBy( array("id" => $this->getUser()->getId()));


        
        return $this->render('dashboard/personal-info/index.html.twig', [
            "user" => $currentUser,
        ]);
    }

    #[Route('/orders', name: 'app_dashboard_orders')]
    public function accessOrders(OrderRepository $orderRepo) {
        
        $orders = $orderRepo->findBy(array("client" => $this->getUser()));
        
        return $this->render('dashboard/orders/index.html.twig', [
            "orders" => $orders
        ]);
    }
}
