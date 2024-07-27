<?php

namespace App\Service;

use App\DTO\ModelDTO;
use App\DTO\OrderRequestDTO;
use App\Entity\Model;
use App\Entity\Order;
use App\Entity\Printer3D;
use App\Repository\ModelRepository;
use App\Repository\OrderRepository;
use App\Repository\PlasticRepository;
use App\Repository\Printer3DRepository;
use App\Traits\OrderStatusTrait;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\DBAL\Exception;
use Doctrine\ORM\EntityManagerInterface;
use Doctrine\ORM\NonUniqueResultException;

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
        private readonly Printer3DRepository $printer3DRepository,
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

    /**
     * @throws NonUniqueResultException
     */
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
            $modelEntityCollection->add($this->modelService->createModel($model, $order, $matchingPlastic));
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

    /**
     * @throws Exception
     */
    public function processOrder(int $orderId): void
    {
        $order = $this->orderRepository->getCreatedOrderById($orderId);
        if($order === null){
            throw new Exception(
                "Order с таким id не найден"
            );
        }
        /** @var ArrayCollection<Model> $modelCollection */
        $modelCollection = $order->getModels();
        /** @var Model $model */
        foreach ($modelCollection as $model) {
            $plastic = $model->getPlastic();
            $requiredPlasticTemperature = $plastic->getMinTemperature();
            $requiredPlasticLength = $model->getPlasticLength();

            $matching3dPrinter = $this->printer3DRepository->get3dPrinterByMaxTemperature($requiredPlasticTemperature);

            if ($matching3dPrinter === null) {
                throw new Exception(
                    sprintf('Нет подходящего 3D принтера для модели %s с id %d  и минимальной температурой %d',
                        $model->getName(), $model->getId(), $requiredPlasticTemperature));
            }
            if (!$this->plasticRepository->checkPlasticLength($requiredPlasticLength)) {
                throw new Exception(
                    sprintf('Недостаточно подходящего пластика для модели %s с id %d',
                        $model->getName(), $model->getId()));
            }
        }

        $order->setStatus($this->inProgress);
        /** @var Model $model */
        foreach ($modelCollection as $model) {
            $plastic = $model->getPlastic();
            $requiredPlasticTemperature = $plastic->getMinTemperature();
            $matching3dPrinter = $this->printer3DRepository->get3dPrinterByMaxTemperature($requiredPlasticTemperature);
            $plastic->setLength($plastic->getLength() - $model->getPlasticLength());
            $order->setCompleteTime($plastic->getLength() * $matching3dPrinter->getPrintSpeed());
        }

        $this->entityManager->persist($order);
        $this->entityManager->flush();
    }
}
