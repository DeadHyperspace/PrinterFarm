<?php

namespace App\Hydrators;

use App\DTO\PlasticDTO;

class PlasticHydrator
{
    static public function hydrate(array $data): PlasticDTO
    {
        $dto = new PlasticDTO();

        $dto->setId($dto->getName['id'] ?? null)
            ->setName($data['name'] ?? null)
            ->setLength($dto->getLength['length'] ?? null)
            ->setDurability($dto->getDurability['durability'] ?? null)
            ->setMinTemperature($dto->getMinTemperature['min_temperature'] ?? null);
        return $dto;
    }
}