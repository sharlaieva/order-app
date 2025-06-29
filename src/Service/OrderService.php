<?php declare(strict_types=1);

namespace App\Service;

use App\DTO\OrderDto;
use App\Repository\OrderRepository;

final class OrderService
{
    /**
     * @param \App\Repository\OrderRepository $orderRepository
     */
    public function __construct(
        private OrderRepository $orderRepository
    ) {
    }

    /**
     * Get order by ID.
     *
     * @param string $orderId
     * @return OrderDto|null
     */
    public function getOrderDetailDtoById(string $orderId): ?OrderDto
    {
        $order = $this->orderRepository->findOrderById($orderId);

        if (null === $order) {
            return null;
        }

        return OrderDto::createFromEntity($order);
    }
}