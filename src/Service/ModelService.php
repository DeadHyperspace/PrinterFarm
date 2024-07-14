<?php

namespace App\Service;

use App\DTO\ModelDTO;
use App\DTO\OrderRequestDTO;
use App\Entity\Model;
use App\Entity\Order;
use App\Repository\ModelRepository;
use Doctrine\ORM\EntityManagerInterface;

class ModelService
{

    public function __construct(
        private readonly ModelRepository $modelRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function getModelByName(string $name): ?Model
    {
        return $this->modelRepository->findOneBy(['name' => $name]);
    }

    public function createModel(ModelDTO $modelDTO, Order $order): Model
    {
        $model = new Model;
        $model->setName($modelDTO->getName())
            ->setOrder($order)
            ->setDurability($modelDTO->getDurability())
            ->setPlasticLength($modelDTO->getPlasticLength());
        return $model;
    }
}