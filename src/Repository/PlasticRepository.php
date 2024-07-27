<?php

namespace App\Repository;

use App\Entity\Order;
use App\Entity\Plastic;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\ORM\NonUniqueResultException;
use Doctrine\Persistence\ManagerRegistry;

class PlasticRepository extends ServiceEntityRepository
{

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Plastic::class);
    }

    /**
     * @throws NonUniqueResultException
     */
    public function getPlasticByDurabilityAndLength(int $durability, int $length): Plastic
    {
        $qb = $this->createQueryBuilder('plastics');
        $plastic = $qb->select('p')
            ->from('App\Entity\Plastic', 'p')
            ->where(sprintf('p.durability >= %d', $durability))
            ->andWhere(sprintf('p.length >= %d', $length))
            ->orderBy('p.durability')
            ->getQuery()->getResult();
        return $plastic[0];
    }

    public function checkPlasticLength(int $requiredLength): bool
    {
        $qb = $this->createQueryBuilder('plastics');
        $plastic = $qb->select('p')
            ->from('App\Entity\Plastic', 'p')
            ->where(sprintf('p.length >= %d', $requiredLength))
            ->orderBy('p.length')
            ->getQuery()->getResult();
        return $plastic === null ? false : true;
    }
}