<?php

namespace App\DTO;

use App\Entity\Order;
use App\Repository\ModelRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

class ModelDTO
{
    private ?int $id;

    private ?string $name;

    private ?int $plasticLength;

    private ?int $durability;

    private ?Collection $orders;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): ModelDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): ModelDTO
    {
        $this->name = $name;
        return $this;
    }

    public function getPlasticLength(): ?int
    {
        return $this->plasticLength;
    }

    public function setPlasticLength(?int $plasticLength): ModelDTO
    {
        $this->plasticLength = $plasticLength;
        return $this;
    }

    public function getDurability(): ?int
    {
        return $this->durability;
    }

    public function setDurability(?int $durability): ModelDTO
    {
        $this->durability = $durability;
        return $this;
    }

    public function getOrders(): ?Collection
    {
        return $this->orders;
    }

    public function setOrders(?Collection $orders): ModelDTO
    {
        $this->orders = $orders;
        return $this;
    }


}