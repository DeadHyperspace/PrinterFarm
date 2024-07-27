<?php

namespace App\Hydrators;

use App\DTO\ModelDTO;
use App\DTO\OrderRequestDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class OrderHydrator
{
    public static function hydrate(array $json): ?OrderRequestDTO
    {
        $orderDTO = new OrderRequestDTO();
        $modelCollection = self::persistModels($json["model"]);
        $orderDTO->setModel($modelCollection);
        return $orderDTO;
    }

    private static function persistModels(array $models): ArrayCollection
    {
        $collection = new ArrayCollection();
        foreach ($models as $model) {
            $collection->add(ModelHydrator::hydrate($model));
        }
        return $collection;
    }
}