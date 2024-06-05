<?php

namespace App\Service;

use App\DTO\OrderDTO;
use App\Entity\Order;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrderService
{

    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function getOrdersById(int $id)
    {
        return $this->orderRepository->findOneBy(['id' => $id]);
    }

    public function createOrder(OrderDTO $orderDTO): Order
    {
        $order = new Order();
        $order->setId($orderDTO->getId())
            ->setCreatedAt($orderDTO->getCreatedAt())
            ->setPrice($orderDTO->getPrice())
            ->setStatus($orderDTO->getStatus())
            ->setModels($orderDTO->getModels());
        $this->entityManager->persist($order);
        $this->entityManager->flush();
        return $order;
    }
}