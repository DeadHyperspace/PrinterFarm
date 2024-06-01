<?php

namespace App\Controller;

use App\Entity\Plastic;
use App\Hydrators\PlasticHydrator;
use App\Service\PlasticService;
use Doctrine\ORM\EntityManagerInterface;
use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PlasticController
{
    /**
     * @param PlasticService $plasticService
     */
    public function __construct(
        private readonly PlasticService $plasticService,
    ) {
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */

    #[Route('/getPlastic', name: 'get_plastic', methods: ['GET'])]
    public function getPlastic(Request $request): JsonResponse
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

        $plastic = $this->plasticService->getPlasticByName($json['name']);
        if ($plastic === null) {
            throw new Exception("Plastic not found");
        }
        return $this->jsonResponseBuilder($plastic);
    }

    #[Route('/createPlastic', name: 'create_plastic', methods: ['POST'])]
    public function createPlastic(Request $request): JsonResponse
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

        if (!array_key_exists('length', $json)) {
            throw new InvalidArgumentException("Invalid json, length not provided");
        }

        if (!is_int($json['length'])) {
            throw new InvalidArgumentException("Invalid json, length not an integer ");
        }

        if (!array_key_exists('durability', $json)) {
            throw new InvalidArgumentException("Invalid json, durability not provided");
        }

        if (!is_int($json['durability'])) {
            throw new InvalidArgumentException("Invalid json, durability not an integer");
        }
        if (!array_key_exists('min_temperature', $json)) {
            throw new InvalidArgumentException("Invalid json, min_temperature not provided");
        }

        if (!is_int($json['min_temperature'])) {
            throw new InvalidArgumentException("Invalid json, min_temperature not an integer");
        }

        $plastic = $this->plasticService->createPlastic(PlasticHydrator::hydrate($json));
        return $this->jsonResponseBuilder($plastic);
    }

    /**
     * @param Plastic $plastic
     * @return JsonResponse
     */
    private function jsonResponseBuilder(Plastic $plastic): JsonResponse
    {
        $jsonResponse = new JsonResponse();
        $json = [
            'id' => $plastic->getId(),
            'name' => $plastic->getName(),
            'length' => $plastic->getLength(),
            'durability' => $plastic->getDurability(),
            'min_temperature' => $plastic->getMinTemperature()
        ];
        $jsonResponse->setData(json_encode($json));
        return $jsonResponse;
    }
}