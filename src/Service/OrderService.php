<?php

namespace App\Service;

use App\DTO\ModelDTO;
use App\DTO\OrderRequestDTO;
use App\Entity\Model;
use App\Entity\Order;
use App\Repository\ModelRepository;
use App\Repository\OrderRepository;
use App\Repository\PlasticRepository;
use App\Traits\OrderStatusTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\EntityManagerInterface;

/**
 *
 */
class OrderService
{
    use OrderStatusTrait;

    /**
     * @param OrderRepository $orderRepository
     * @param EntityManagerInterface $entityManager
     * @param PlasticRepository $plasticRepository
     */
    public function __construct(
        private readonly OrderRepository $orderRepository,
        private readonly EntityManagerInterface $entityManager,
        private readonly PlasticRepository $plasticRepository,
        private readonly ModelService $modelService
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

    public function createOrder(OrderRequestDTO $orderRequestDTO): Order
    {
        $modelsCollection = $orderRequestDTO->getModel();
        $order = new Order;
        $orderPrice = 0;
        /** @var ArrayCollection<Model> $modelEntityCollection */
        $modelEntityCollection = new ArrayCollection();
        /** @var ModelDTO $model */
        foreach ($modelsCollection as $model) {
            $plasticDurabilityFromModel = $model->getDurability();
            $plasticLengthFromModel = $model->getPlasticLength();
            $matchingPlastic = $this->plasticRepository->getPlasticByDurabilityAndLength($plasticDurabilityFromModel,
                $plasticLengthFromModel);
            $modelEntityCollection->add($this->modelService->createModel($model,$order));
            $orderPrice += $matchingPlastic->getPricePerMeter() * $plasticLengthFromModel;
        }
        $order->setPrice($orderPrice)
            ->setStatus($this->created)
            ->setCreatedAt(new DateTime())
            ->setModels($modelEntityCollection);
        $this->entityManager->persist($order);
        $this->entityManager->flush();
        return $order;
    }

}
