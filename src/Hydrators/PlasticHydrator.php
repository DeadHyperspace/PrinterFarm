<?php

namespace App\Hydrators;

use App\DTO\PlasticDTO;

class PlasticHydrator
{
    static public function hydrate(array $data): PlasticDTO
    {

        $dto = new PlasticDTO();
        $dto->setId($data['id'] ?? null)
            ->setName($data['name'] ?? null)
            ->setLength($data['length'] ?? null)
            ->setDurability($data['durability'] ?? null)
            ->setMinTemperature($data['min_temperature'] ?? null)
            ->setPricePerMeter($data['price_per_meter'] ?? null);
        return $dto;
    }
}