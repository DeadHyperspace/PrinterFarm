<?php

namespace App\DTO;

use App\Entity\Model;
use DateTime;
use Doctrine\Common\Collections\Collection;

class OrderDTO
{
    private ?int $id;
    private ?DateTime $createdAt;
    private ?int $price;
    private ?int $status;
    private ?Collection $models;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): OrderDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getCreatedAt(): ?DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(?DateTime $createdAt): OrderDTO
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getPrice(): ?int
    {
        return $this->price;
    }

    public function setPrice(?int $price): OrderDTO
    {
        $this->price = $price;
        return $this;
    }

    public function getStatus(): ?int
    {
        return $this->status;
    }

    public function setStatus(?int $status): OrderDTO
    {
        $this->status = $status;
        return $this;
    }

    public function getModels(): ?Collection
    {
        return $this->models;
    }

    public function setModels(?Collection $models): OrderDTO
    {
        $this->models = $models;
        return $this;
    }

    public function getModelNames(): array
    {
        return array_map(function (Model $model) {
            return $model->getName();
        }, (array)$this->models);
    }

}