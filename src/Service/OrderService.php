<?php
namespace App\Service;

use App\DTO\OrderDTO;
use App\Entity\Model;
use App\Entity\Order;
use App\Repository\ModelRepository;
use App\Repository\OrderRepository;
use Doctrine\ORM\EntityManagerInterface;

class OrderService
{
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly ModelRepository $modelRepository,
        private readonly EntityManagerInterface $entityManager,
    ) {
    }

    public function getOrdersById(int $id)
    {
        return $this->orderRepository->findOneBy(['id' => $id]);
    }

    public function getModelsByNames(array $modelNames): array
    {
        return $this->modelRepository->findBy(['name' => $modelNames]);
    }

    public function createOrder(OrderDTO $orderDTO): Order
    {
        $order = new Order();
        $order->setId($orderDTO->getId())
            ->setCreatedAt($orderDTO->getCreatedAt())
            ->setPrice($orderDTO->getPrice())
            ->setStatus($orderDTO->getStatus());

        $models = $this->getModelsByNames($orderDTO->getModelNames());
        foreach ($models as $model) {
            $order->addModel($model);
        }

        $this->entityManager->persist($order);
        $this->entityManager->flush();
        return $order;
    }
}
