<?php

namespace App\Entity;

use App\Repository\PlasticRepository;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Table(name: 'plastics'),
    ORM\Entity(repositoryClass: PlasticRepository::class)
]
class Plastic
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'name', type: 'string')]
    private string $name;

    #[ORM\Column(name: 'length', type: 'integer')]
    private int $length;

    #[ORM\Column(name: 'durability', type: 'integer')]
    private int $durability;

    #[ORM\Column(name: 'min_temperature', type: 'integer')]
    private int $minTemperature;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Plastic
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Plastic
    {
        $this->name = $name;
        return $this;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): Plastic
    {
        $this->length = $length;
        return $this;
    }

    public function getDurability(): int
    {
        return $this->durability;
    }

    public function setDurability(int $durability): Plastic
    {
        $this->durability = $durability;
        return $this;
    }

    public function getMinTemperature(): int
    {
        return $this->minTemperature;
    }

    public function setMinTemperature(int $minTemperature): Plastic
    {
        $this->minTemperature = $minTemperature;
        return $this;
    }


}