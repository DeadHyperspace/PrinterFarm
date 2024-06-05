<?php

namespace App\Service;

use App\DTO\Printer3DDTO;
use App\Entity\Printer3D;
use App\Repository\Printer3DRepository;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\Query\Printer;

class Printer3DService
{

    /**
     * @param Printer3DRepository $printer3DRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        private readonly Printer3DRepository $printer3DRepository,
        private readonly EntityManagerInterface $entityManager
    ) {
    }

    /**
     * @param string $name - Модель принтера
     * @return Printer3D|null
     */
    public function getPrinterByName(string $name): ?Printer3D
    {
        return $this->printer3DRepository->findOneBy(['name' => $name]);
    }

    /**
     * @param Printer3DDTO $printer3DDTO
     * @return Printer3D
     */
    public function createPrinter(Printer3DDTO $printer3DDTO): Printer3D
    {
        $printer = new Printer3D();
        $printer->setName($printer3DDTO->getName())
            ->setMaxTemperature($printer3DDTO->getMaxTemperature())
            ->setPrintSpeed($printer3DDTO->getPrintSpeed());

        $this->entityManager->persist($printer);
        $this->entityManager->flush();

        return $printer;
    }
}