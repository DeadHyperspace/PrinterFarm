<?php

namespace App\Hydrators;

use App\DTO\ModelDTO;
use App\DTO\OrderDTO;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;

class OrderHydrator
{
    public function hydrate($data): OrderDTO
    {
        $dto = new OrderDTO();
        $dto->setId($data['id'] ?? null)
            ->setCreatedAt($data['created_at'] ?? null)
            ->setStatus($data['status'] ?? null)
            ->setPrice($data['price'] ?? null)
            ->setModels($this->persistModels($data['models'] ?? null));
        return $dto;
    }

    private function persistModels(array $models): Collection
    {
        $collection = new ArrayCollection();
        foreach ($models as $model) {
            $collection->add(ModelHydrator::hydrate($model));
        }
        return $collection;
    }
}