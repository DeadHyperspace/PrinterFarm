<?php

namespace App\Controller;

use App\Entity\Model;
use App\Entity\Model3D;
use App\Hydrators\Model3DHydrator;
use App\Hydrators\ModelHydrator;
use App\Service\ModelService;
use App\Service\Model3DService;
use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class ModelController
{


    public function __construct(
        private readonly ModelService $modelService,
    ) {
    }


    /**
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */

    #[Route('/getModel', name: 'get_model', methods: ['GET'])]
    public function getModel(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        if (!is_array($json)) {
            throw new InvalidArgumentException("Invalid json");
        }

        if (!array_key_exists('name', $json)) {
            throw new InvalidArgumentException("Invalid json, name not provided");
        }

        if (!is_string($json['name'])) {
            throw new InvalidArgumentException("Invalid json, name not a string");
        }

        $model = $this->modelService->getModelByName($json['name']);
        if ($model === null) {
            throw new Exception("Model not found");
        }
        return $this->jsonResponseBuilder($model);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/createModel', name: 'create_model', methods: ['POST'])]
    public function createModel(Request $request): JsonResponse
    {
        $json = json_decode($request->getContent(), true);

        if (!is_array($json)) {
            throw new InvalidArgumentException("Invalid json");
        }

        if (!array_key_exists('name', $json)) {
            throw new InvalidArgumentException("Invalid json, name not provided");
        }

        if (!is_string($json['name'])) {
            throw new InvalidArgumentException("Invalid json, name not a string");
        }

        if (!array_key_exists('plastic_length', $json)) {
            throw new InvalidArgumentException("Invalid json, plastic_length not provided");
        }

        if (!is_int($json['plastic_length'])) {
            throw new InvalidArgumentException("Invalid json, plastic_length not an integer ");
        }

        if (!array_key_exists('durability', $json)) {
            throw new InvalidArgumentException("Invalid json, durability not provided");
        }

        if (!is_int($json['durability'])) {
            throw new InvalidArgumentException("Invalid json, durability not an integer");
        }

        $model = $this->modelService->createModel(ModelHydrator::hydrate($json));
        return $this->jsonResponseBuilder($model);
    }

    /**
     * @param Model $model
     * @return JsonResponse
     */
    private function jsonResponseBuilder(Model $model): JsonResponse
    {
        $jsonResponse = new JsonResponse();
        $json = [
            'id' => $model->getId(),
            'name' => $model->getName(),
            'plastic_length' => $model->getPlasticLength(),
            'durability' => $model->getDurability(),
            'order_id' => $model->getOrders()
        ];
        $jsonResponse->setData(json_encode($json));
        return $jsonResponse;
    }
}
