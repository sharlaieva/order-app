<?php declare(strict_types=1);

namespace App\Repository;

use App\Entity\Currency;

interface CurrencyRepositoryInterface extends RepositoryInterface
{
    public function findByCode(string $code): ?Currency;
}