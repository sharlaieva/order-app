<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\OrderStatus;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<OrderStatus>
 */
final class OrderStatusRepository extends ServiceEntityRepository implements RepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderStatus::class);
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