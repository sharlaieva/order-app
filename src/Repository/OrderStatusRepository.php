<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\OrderStatus;
use Doctrine\Persistence\ManagerRegistry;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;

/**
 * @extends ServiceEntityRepository<OrderStatus>
 */
final class OrderStatusRepository extends \Doctrine\ORM\EntityRepository
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, OrderStatus::class);
    }
}