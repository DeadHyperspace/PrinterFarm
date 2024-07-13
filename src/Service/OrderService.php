<?php

namespace App\Service;

use App\DTO\OrderRequestDTO;
use App\Entity\Model;
use App\Entity\Order;
use App\Repository\ModelRepository;
use App\Repository\OrderRepository;
use App\Repository\PlasticRepository;
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
        private readonly PlasticRepository $plasticRepository,
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

    public function countFullPriceForOrder(OrderRequestDTO $orderRequestDTO): int
    {
        $modelsCollection = $orderRequestDTO->getModel();
        foreach ($modelsCollection as $model){

//            var_dump($model->getName());
//            var_dump($model->getPlasticLength());
        }
        $plastic = $this->plasticRepository->findOneBy(['durability' => 50]);
        var_dump($plastic);
        var_dump($plastic->getDurability());
        die;

    return 0;
    }

    /**
     * @param OrderRequestDTO $orderDTO
     * @return Order
     */
    public function createOrder(OrderRequestDTO $orderDTO): Order
    {
        $order = new Order();
        $order->setId($orderDTO->getId())
            ->setModels($orderDTO->getModels())
            ->setStatus($orderDTO->getStatus())
            ->setCreatedAt($orderDTO->getCreatedAt())
            ->setPrice($this->countFullPriceForOrder());


        $this->entityManager->persist($order);
        $this->entityManager->flush();
        return $order;
    }
}
