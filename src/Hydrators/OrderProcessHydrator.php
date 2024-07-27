<?php

namespace App\Hydrators;

use App\DTO\OrderProcessDTO;

class OrderProcessHydrator
{
    static public function hydrate(array $data): OrderProcessDTO
    {
        $dto = new OrderProcessDTO();
        $dto->setId($data["id"]);

        return $dto;
    }
}