<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\OrderRepository;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class OrderController extends AbstractController
{
    #[Route('/', name: 'order_list')]
    public function index(OrderRepository $orderRepository): Response
    {
        $orders = $orderRepository->findAll();

        return $this->render('order/index.html.twig', [
            'orders' => $orders,
        ]);
    }
}