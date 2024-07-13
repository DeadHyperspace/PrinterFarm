<?php

namespace App\Hydrators;

use App\DTO\ModelDTO;

class ModelHydrator
{

    static public function hydrate(array $data): ModelDTO
    {
        $dto = new ModelDTO();
        $dto->setName($data["name"] ?? null)
            ->setDurability($data["durability"] ?? null)
            ->setPlasticLength($data["plastic_length"] ?? null);
        return $dto;
    }
}