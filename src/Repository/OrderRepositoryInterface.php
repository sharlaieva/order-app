<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Order;

interface OrderRepositoryInterface extends RepositoryInterface
{
    /**
     * @return OrderDto[]
     */
    public function findAllOrders(): array;

    public function findOrderById(string $orderId): ?Order;
}