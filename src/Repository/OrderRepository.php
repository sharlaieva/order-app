<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Order>
 */
class OrderRepository extends ServiceEntityRepository implements OrderRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

   public function findAll(): array
    {
        return parent::findAll();
    }

    public function save(object $entity): void
    {
        $this->_em->persist($entity);
        $this->_em->flush();
    }

    public function delete(object $entity): void
    {
        $this->_em->remove($entity);
        $this->_em->flush();
    }

    public function findOrderById(string $orderId): ?Order
    {
        return $this->findOneBy(['orderId' => $orderId]);
    }

    /**
     * @retun array<Order>
     */
    public function findAllOrders(): array
    {
        return $this->findAll();
    }
}
