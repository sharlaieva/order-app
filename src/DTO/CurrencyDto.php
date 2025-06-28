<?php declare(strict_types=1);

namespace App\DTO;

use App\Entity\Currency;

final class CurrencyDto
{
    public ?string $code = null;
    public ?string $name = null;

    public static function createFromEntity(Currency $currency): self
    {
        $dto = new self();
        $dto->code = $currency->getCode();
        $dto->name = $currency->getName();

        return $dto;
    }
}