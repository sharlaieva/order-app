<?php declare(strict_types=1);

namespace App\DTO;

use App\Entity\Product;

final class ProductDto implements \JsonSerializable
{
    public ?int $id = null;
    public ?string $name = null;
    public ?string $description = null;
    public ?string $price = null;
    public ?string $currencyCode = null;

    public static function createFromEntity(Product $product): self
    {
        $dto = new self();
        $dto->id = $product->getId();
        $dto->name = $product->getName();
        $dto->description = $product->getDescription();
        $dto->price = (string)$product->getPrice();
        $dto->currencyCode = $product->getCurrency()->getCode();

        return $dto;
    }

    public function jsonSerialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'description' => $this->description,
            'price' => $this->price,
            'currencyCode' => $this->currencyCode,
        ];
    }
}