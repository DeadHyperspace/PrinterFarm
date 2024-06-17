<?php

namespace App\Service;

use App\DTO\OrderDTO;
use App\Entity\Model;
use App\Entity\Order;
use App\Repository\ModelRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;

/**
 *
 */
class OrderService
{
    /**
     * @param OrderRepository $orderRepository
     * @param ModelRepository $modelRepository
     * @param EntityManagerInterface $entityManager
     */
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    /**
     * @param int $id
     * @return object|null
     */
    public function getOrdersById(int $id): ?Order
    {
        return $this->orderRepository->findOneBy(['id' => $id]);
    }

    public function countPrice(array $models): int
    {
        $totalPrice = 0;
        $basicPrice = 5000;
        $plasticLength = [];
        $pricePerMeter = [];
        $durability = [];
        foreach ($models as $model) {
            $gettingDurabilitySQL = "SELECT durability, FROM models WHERE id = :id";
            $statement = $this->entityManager->getConnection()->prepare($gettingDurabilitySQL);
            $statement->bindValue(':id', $model->getId());
            $statement->executeQuery();
            $durability[] += $statement->fetchOne();
        }
        foreach ($models as $model) {
            $gettingPlasticLengthSQL = "SELECT plastic_length, FROM models WHERE id = :id";
            $statement = $this->entityManager->getConnection()->prepare($gettingPlasticLengthSQL);
            $statement->bindValue(':id', $model->getId());
            $statement->executeQuery();
            $plasticLength[] += $statement->fetchOne();
        }
        foreach ($durability as $durabilityModel) {
            $getPricePerMeter = "SELECT price_per_meter, FROM plastics WHERE durability = :durability";
            $statement = $this->entityManager->getConnection()->prepare($gettingPlasticLengthSQL);
            $statement->bindValue(':durability', $durabilityModel);
            $statement->executeQuery();
            $pricePerMeter[] += $statement->fetchOne();
        }

        foreach ($plasticLength as $key => $value) {
            $totalPrice += $value * $pricePerMeter[$key];
        }
        $totalPrice += $basicPrice;
        return $totalPrice;
    }

    /**
     * @param OrderDTO $orderDTO
     * @return Order
     */
    public function createOrder(OrderDTO $orderDTO): Order
    {
        $order = new Order();
        $order->setId($orderDTO->getId())
            ->setModels($orderDTO->getModels())
            ->setStatus($orderDTO->getStatus())
            ->setCreatedAt($orderDTO->getCreatedAt())
            ->setPrice($orderDTO->getPrice());


        $this->entityManager->persist($order);
        $this->entityManager->flush();
        return $order;
    }
}
