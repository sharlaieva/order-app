<?php declare(strict_types=1);

namespace App\DTO;

class OrderItemDto implements \JsonSerializable
{
    public ?int $id = null;
    public ?string $productName = null;
    public ?string $price = null;
    public ?int $quantity = null;
    public ?string $currencyCode = null;
    public ?ProductDto $product = null;

    public static function createFromEntity(\App\Entity\OrderItem $orderItem): self
    {
        $dto = new self();
        $dto->id = $orderItem->getId();
        $dto->productName = $orderItem->getProductName();
        $dto->price = $orderItem->getUnitPrice();
        $dto->quantity = $orderItem->getQuantity();
        $dto->currencyCode = $orderItem->getOrder()->getCurrency()->getCode();
        $dto->product = $orderItem->getProduct() ? ProductDto::createFromEntity($orderItem->getProduct()) : null;
        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->productName,
            'price' => $this->price,
            'currencyCode' => $this->currencyCode,
            'quantity' => $this->quantity,
            'product' => $this->product ? $this->product->jsonSerialize() : null,
        ];
    }
}
