<?php declare(strict_types=1);

namespace App\Repository;

interface RepositoryInterface
{
    public function find(int $id): ?object;

    /** @return object[] */
    public function findAll(): array;

    public function save(object $entity): void;

    public function delete(object $entity): void;
}