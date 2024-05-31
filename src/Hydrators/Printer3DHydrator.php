<?php

namespace App\Hydrators;

use App\DTO\Printer3DDTO;

class Printer3DHydrator
{

    static public function hydrate(array $data): Printer3DDTO
    {
        $dto = new Printer3DDTO();

        $dto->setId($data['id'] ?? null)
            ->setName($data['name'] ?? null)
            ->setMaxTemperature($data['max_temperature'] ?? null)
            ->setPrintSpeed($data['print_speed'] ?? null);
        return $dto;
    }

}