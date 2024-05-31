<?php

namespace App\Controller;

use App\Entity\Printer3D;
use App\Hydrators\Printer3DHydrator;
use App\Service\Printer3DService;
use Exception;
use InvalidArgumentException;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Attribute\Route;

class PrinterController
{
    /**
     * @param Printer3DService $printer3DService
     */

    public function __construct(
        private readonly Printer3DService $printer3DService
    ) {
    }


    /**
     *
     * @param Request $request
     * @return JsonResponse
     * @throws Exception
     */
    #[Route('/getPrinter', name: 'get_printer', methods: ['GET'])]
    public function getPrinter(Request $request): JsonResponse
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

        $printer = $this->printer3DService->getPrinterByModel($json['name']);
        if ($printer === null) {
            throw new Exception("Printer not found");
        }
        return $this->jsonResponseBuilder($printer);
    }

    /**
     * @param Request $request
     * @return JsonResponse
     */
    #[Route('/createPrinter', name: 'create_printer', methods: ['POST'])]
    public function createPrinter(Request $request): JsonResponse
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

        if (!array_key_exists('max_temperature', $json)) {
            throw new InvalidArgumentException("Invalid json, max_temperature not provided");
        }

        if (!is_int($json['max_temperature'])) {
            throw new InvalidArgumentException("Invalid json, max_temperature not an integer ");
        }

        if (!array_key_exists('print_speed', $json)) {
            throw new InvalidArgumentException("Invalid json, print_speed not provided");
        }

        if (!is_int($json['print_speed'])) {
            throw new InvalidArgumentException("Invalid json, print_speed not an integer");
        }

        $printer = $this->printer3DService->createPrinter(Printer3DHydrator::hydrate($json));
        return $this->jsonResponseBuilder($printer);
    }

    /**
     * @param Printer3D $printer3D
     * @return JsonResponse
     */
    private function jsonResponseBuilder(Printer3D $printer3D): JsonResponse
    {
        $jsonResponse = new JsonResponse();
        $json = [
            'id' => $printer3D->getId(),
            'name' => $printer3D->getName(),
            'max_temperature' => $printer3D->getMaxTemperature(),
            'print_speed' => $printer3D->getPrintSpeed(),
            'arrived_at' => $printer3D->getArrivedAt()->format('Y-m-d H:i:s'),
        ];
        $jsonResponse->setData(json_encode($json));
        return $jsonResponse;
    }
}
