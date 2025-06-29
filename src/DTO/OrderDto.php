<?php declare(strict_types=1);

namespace App\DTO;

use App\Entity\Order;
use App\Entity\OrderItem;

final class OrderDto implements \JsonSerializable
{
    public ?string $orderId = null;
    public ?\DateTimeInterface $createdAt = null;
    public ?string $name = null;
    public ?float $amount = null;
    public ?CurrencyDto $currency = null;
    public ?OrderStatusDto $status = null;
     /** @var OrderItemDto[] */
    public array $items = [];

    public static function createFromEntity(Order $order): self
    {
        $dto = new self();
        $dto->orderId = $order->getOrderId();
        $dto->name = $order->getName();
        $dto->amount = $order->getAmount();
        $dto->currency = $order->getCurrency() ? CurrencyDto::createFromEntity($order->getCurrency()) : null;
        $dto->status = $order->getStatus() ? OrderStatusDto::createFromEntity($order->getStatus()) : null;
        $dto->items = array_map(
        fn(OrderItem $item) => OrderItemDto::createFromEntity($item),
        $order->getItems()->toArray()
    );

        return $dto;
    }

    /** @return array<string, mixed> */
    public function jsonSerialize(): array
    {
        return [
            'id' => $this->orderId,
            'name' => $this->name,
            'amount' => $this->amount,
            'currency' => $this->currency,
            'status' => $this->status,
            'createdAt' => $this->createdAt,
        ];
    }
}
