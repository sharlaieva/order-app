<?php declare(strict_types=1);

namespace App\DTO;

class OrderItemDto
{
    public ?int $id = null;
    public ?string $productName = null;
    public ?string $price = null;
    public ?int $quantity = null;
    public ?string $currencyCode = null;

    public static function createFromEntity(\App\Entity\OrderItem $orderItem): self
    {
        $dto = new self();
        $dto->id = $orderItem->getId();
        $dto->productName = $orderItem->getProductName();
        $dto->price = $orderItem->getUnitPrice();
        $dto->quantity = $orderItem->getQuantity();
        $dto->currencyCode = $orderItem->getOrder()->getCurrency()->getCode();
        return $dto;
    }
}
