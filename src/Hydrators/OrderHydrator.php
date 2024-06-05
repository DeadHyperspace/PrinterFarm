<?php

namespace App\Hydrators;

use App\DTO\OrderDTO;

class OrderHydrator
{
    static public function hydrate($data): OrderDTO
    {
        $dto = new OrderDTO();
        $dto->setId($data['id'] ?? null)
        ->setCreatedAt($data['created_at'] ?? null)
        ->setStatus($data['status'] ?? null)
        ->setPrice($data['price'] ?? null);

        return $dto;
    }
}