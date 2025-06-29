<?php

namespace App\Repository;

use App\Entity\OrderItem;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<OrderItem>
 */
class OrderItemRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderItem::class);
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
}
