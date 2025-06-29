<?php declare(strict_types=1);

namespace App\Controller;

use App\Repository\OrderRepository;
use App\Service\OrderService;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class OrderController extends AbstractController
{
    #[Route('/', name: 'order_list')]
    public function index(OrderService $orderService): Response
    {
        $orders = $orderService->getOrderList();

        return $this->render('order/index.html.twig', [
            'orders' => $orders,
        ]);
    }

    #[Route('/orders/{orderId}', name: 'order_detail', methods: ['GET'])]
    public function detail(string $orderId, OrderService $orderService): Response
    {
        $order = $orderService->getOrderDetailDtoById($orderId);

        if (!$order) {
            $this->addFlash('danger', 'Objednávka nenalezena');

            return $this->redirectToRoute('order_list');
        }

        return $this->render('order/detail.html.twig', [
            'order' => $order,
        ]);
    }
}