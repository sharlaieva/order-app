<?php

namespace App\Repository;

use App\Entity\Currency;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

/**
 * @extends ServiceEntityRepository<Currency>
 */
class CurrencyRepository extends ServiceEntityRepository implements CurrencyRepositoryInterface
{
    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Currency::class);
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

    public function findByCode(string $code): ?Currency
    {
        return $this->findOneBy(['code' => $code]);
    }
}
