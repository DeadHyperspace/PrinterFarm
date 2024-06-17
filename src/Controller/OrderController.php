<?php

namespace App\Controller;

use App\Entity\Order;
use App\Hydrators\OrderHydrator;
use App\Service\OrderService;
use Doctrine\Common\Collections\Collection;
use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class OrderController
{
    public function __construct(
        private readonly OrderService $orderService,
    ) {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */


    #[Route('/getOrder', name: 'get_order', methods: ['GET'])]
    public function getOrder(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        if (!is_array($json)) {
            throw new InvalidArgumentException("Invalid json");
        }

        if (!array_key_exists('id', $json)) {
            throw new InvalidArgumentException("Invalid json, id not provided");
        }

        if (!is_int($json['id'])) {
            throw new InvalidArgumentException("Invalid json, id not a int");
        }

        $order = $this->orderService->getOrdersById($json['id']);
        if ($order === null) {
            throw new Exception("Order not found");
        }
        return $this->jsonResponseBuilder($order);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */

    #[Route('/createOrder', name: 'create_order', methods: ['POST'])]
    public function createOrder(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        if (!is_array($json)) {
            throw new InvalidArgumentException("Invalid json");
        }

        if (!array_key_exists('id', $json)) {
            throw new InvalidArgumentException("Invalid json, id not provided");
        }

        if (!is_string($json['id'])) {
            throw new InvalidArgumentException("Invalid json, id not a string");
        }

        if (!array_key_exists('price', $json)) {
            throw new InvalidArgumentException("Invalid json, price not provided");
        }

        if (!is_int($json['price'])) {
            throw new InvalidArgumentException("Invalid json, price not an integer");
        }

        if (!array_key_exists('status', $json)) {
            throw new InvalidArgumentException("Invalid json, price not provided");
        }

        if (!is_string($json['status'])) {
            throw new InvalidArgumentException("Invalid json, price not an integer");
        }

        $order = $this->orderService->createOrder(OrderHydrator::hydrate($json));
        return $this->jsonResponseBuilder($order);
    }

    /**
     * @param Order $order
     * @return JsonResponse
     */
    private function jsonResponseBuilder(Order $order): JsonResponse
    {
        $jsonResponse = new JsonResponse();
        $json = [
            'id' => $order->getId(),
            'price' => OrderService::countPrice($order->getPrice()),
            'status' => $order->getStatus(),
            'created_at' => $order->getCreatedAt(),
            'models' => $this->persistsModels($order->getModels()),
        ];
        $jsonResponse->setData(json_encode($json));
        return $jsonResponse;
    }

    private function persistsModels(Collection $models): array
    {
        $persistModels = [];
        foreach ($models as $model) {
            $persistModels[] = [
                'id' => $model->getId(),
                'name' => $model->getName(),
                'plastic_length' => $model->getPlasticLength(),
                'durability' => $model->getDurability(),
            ];
        }
        return $persistModels;
    }
}
