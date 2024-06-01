<?php

namespace App\Service;

use App\DTO\ModelDTO;
use App\Entity\Model;
use App\Repository\ModelRepository;
use Doctrine\ORM\EntityManager;
use Doctrine\ORM\EntityManagerInterface;

class ModelService
{

    public function __construct(
        private readonly ModelRepository $modelRepository,
        private readonly EntityManagerInterface $entityManager,
    )
    {
    }

    public function getModelByName(string $name): ?Model
    {
        return $this->modelRepository->findOneBy(['name' => $name]);
    }

    public function createModel(ModelDTO $modelDTO): Model
    {
        $model = new Model();
        $model->setName($modelDTO->getName())
            ->setPlasticLength($modelDTO->getPlasticLength())
            ->setDurability($modelDTO->getDurability());

        $this->entityManager->persist($model);
        $this->entityManager->flush();

        return $model;
    }
}