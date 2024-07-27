<?php

namespace App\Repository;

use App\Entity\Order;
use Doctrine\Bundle\DoctrineBundle\Repository\ServiceEntityRepository;
use Doctrine\Persistence\ManagerRegistry;
use \App\Traits\OrderStatusTrait;

class OrderRepository extends ServiceEntityRepository
{
    use OrderStatusTrait;

    public function __construct(ManagerRegistry $registry)
    {
        parent::__construct($registry, Order::class);
    }

    public function getCreatedOrderById(int $id): ?Order
    {

        $qb = $this->createQueryBuilder('orders');
        $order = $qb->select('o')
            ->from('App\Entity\Order', 'o')
            ->where(sprintf('o.id = %d', $id))
            ->andWhere(sprintf("o.status = '%s'", $this->created))
            ->orderBy('o.id')
            ->getQuery()->getResult();

        return $order[0] ?? null;
    }
}