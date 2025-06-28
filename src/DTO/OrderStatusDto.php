<?php declare(strict_types=1);

namespace App\DTO;

use App\Entity\OrderStatus;

final class OrderStatusDto
{
    public ?int $id = null;
    public ?string $name = null;

    public static function createFromEntity(OrderStatus $orderStatus): self
    {
        $dto = new self();
        $dto->id = $orderStatus->getId();
        $dto->name = $orderStatus->getName();

        return $dto;
    }
}