<?php

namespace App\DTO;

class Printer3DDTO
{
    private ?int $id;
    private ?string $name;
    private ?int $printSpeed;
    private ?int $maxTemperature;

    public function __construct()
    {
    }

    public function getId(): ?int
    {
        return $this->id;
    }

    public function setId(?int $id): Printer3DDTO
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): ?string
    {
        return $this->name;
    }

    public function setName(?string $name): Printer3DDTO
    {
        $this->name = $name;
        return $this;

    }

    public function getPrintSpeed(): ?int
    {
        return $this->printSpeed;
    }

    public function setPrintSpeed(?int $printSpeed): Printer3DDTO
    {
        $this->printSpeed = $printSpeed;
        return $this;

    }

    public function getMaxTemperature(): ?int
    {
        return $this->maxTemperature;
    }

    public function setMaxTemperature(?int $maxTemperature): Printer3DDTO
    {
        $this->maxTemperature = $maxTemperature;
        return $this;

    }


}