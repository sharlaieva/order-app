<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;
use Twig\Environment;

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

    #[Route('/orders/{orderId}', name: 'order_detail', methods: ['GET'])]
    public function detail(string $orderId, OrderService $orderService, Environment $twig): Response
    {
        $order = $orderService->getOrderDetailDtoById($orderId);

        if (!$order) {
            $this->addFlash('error', 'Objednávka nenalezena');

            return $this->redirectToRoute('order_list');
        }

        return $this->render('order/detail.html.twig', [
            'order' => $order,
        ]);
    }
}