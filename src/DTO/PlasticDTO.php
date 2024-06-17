<?php

namespace App\DTO;

class PlasticDTO
{
    private ?int $id;
    private ?string $name;
    private ?int $length;
    private ?int $durability;
    private ?int $minTemperature;

    private ?int $pricePerMeter;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): PlasticDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): PlasticDTO
    {
        $this->name = $name;
        return $this;
    }

    public function getLength(): ?int
    {
        return $this->length;
    }

    public function setLength(?int $length): PlasticDTO
    {
        $this->length = $length;
        return $this;
    }

    public function getDurability(): ?int
    {
        return $this->durability;
    }

    public function setDurability(?int $durability): PlasticDTO
    {
        $this->durability = $durability;
        return $this;
    }

    public function getMinTemperature(): ?int
    {
        return $this->minTemperature;
    }

    public function setMinTemperature(?int $minTemperature): PlasticDTO
    {
        $this->minTemperature = $minTemperature;
        return $this;
    }

    public function getPricePerMeter(): ?int
    {
        return $this->pricePerMeter;
    }

    public function setPricePerMeter(?int $pricePerMeter): PlasticDTO
    {
        $this->pricePerMeter = $pricePerMeter;
        return $this;
    }


}