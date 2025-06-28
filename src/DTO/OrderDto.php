<?php declare(strict_types=1);

namespace App\DTO;

use App\Entity\Order;

final class OrderDto
{
    public ?string $orderId = null;
    public ?\DateTimeInterface $createdAt = null;
    public ?string $name = null;
    public ?float $amount = null;
    public ?CurrencyDto $currency = null;
    public ?string $currencyCode = null;

    public static function createFromEntity(Order $order): self
    {
        $dto = new self();
        $dto->orderId = $order->getOrderId();
        $dto->name = $order->getName();
        $dto->amount = $order->getAmount();
        $dto->currency = $order->getCurrency() ? CurrencyDto::createFromEntity($order->getCurrency()) : null;

        return $dto;
    }
}
