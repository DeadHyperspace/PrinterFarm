<?php

namespace App\Service;

use App\DTO\PlasticDTO;
use App\Entity\Plastic;
use App\Repository\PlasticRepository;
use Doctrine\ORM\EntityManagerInterface;

class PlasticService
{
    /**
     * @param PlasticRepository $plasticRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        private readonly PlasticRepository $plasticRepository,
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @param string $name - тип пластика
     * @return Plastic|null
     */
    public function getPlasticByName(string $name): ?Plastic
    {
        return $this->plasticRepository->findOneBy(['name' => $name]);
    }

    /**
     * @param PlasticDTO $dto
     * @return Plastic
     */
    public function createPlastic(PlasticDTO $dto): Plastic
    {
        $plastic = new Plastic();
        $plastic->setName($dto->getName())
            ->setLength($dto->getLength())
            ->setDurability($dto->getDurability())
            ->setMinTemperature($dto->getMinTemperature());

        $this->entityManager->persist($plastic);
        $this->entityManager->flush();

        return $plastic;
    }
}