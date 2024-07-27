<?php

namespace App\Repository;

use App\Entity\Printer3D;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;

class Printer3DRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Printer3D::class);
    }

    public function get3dPrinterByMaxTemperature(int $minTempOfPlastic): ?Printer3D
    {
        $qb = $this->createQueryBuilder('printers_3d');
        $printer = $qb->select('p')
            ->from('App\Entity\Printer3D', 'p')
            ->where(sprintf('p.maxTemperature >= %d', $minTempOfPlastic))
            ->orderBy('p.maxTemperature')
            ->getQuery()->getResult();

        return $printer[0] ?? null;
    }
}