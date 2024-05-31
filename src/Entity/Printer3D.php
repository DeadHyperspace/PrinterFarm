<?php

namespace App\Entity;

use App\Repository\Printer3DRepository;
use DateTime;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Table(name: 'printers_3d'),
    ORM\Entity(repositoryClass: Printer3DRepository::class)
]
class Printer3D
{

    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'name', type: 'string')]
    private string $name;

    #[ORM\Column(name: 'max_temperature', type: 'integer')]
    private int $maxTemperature;

    #[ORM\Column(name: 'print_speed', type: 'integer')]
    private int $printSpeed;

    #[ORM\Column(name: 'arrived_at', type: 'datetime')]
    private DateTime $arrivedAt;

    public function __construct()
    {
        $this->arrivedAt = new DateTime();
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Printer3D
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Printer3D
    {
        $this->name = $name;
        return $this;
    }

    public function getMaxTemperature(): int
    {
        return $this->maxTemperature;
    }

    public function setMaxTemperature(int $maxTemperature): Printer3D
    {
        $this->maxTemperature = $maxTemperature;
        return $this;
    }

    public function getPrintSpeed(): int
    {
        return $this->printSpeed;
    }

    public function setPrintSpeed(int $printSpeed): Printer3D
    {
        $this->printSpeed = $printSpeed;
        return $this;
    }

    public function getArrivedAt(): DateTime
    {
        return $this->arrivedAt;
    }

    public function setArrivedAt(DateTime $arrivedAt): Printer3D
    {
        $this->arrivedAt = $arrivedAt;
        return $this;
    }


}