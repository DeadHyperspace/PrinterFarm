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

    public function setId(int $id): void
    {
        $this->id = $id;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): void
    {
        $this->name = $name;
    }

    public function getLength(): int
    {
        return $this->length;
    }

    public function setLength(int $length): void
    {
        $this->length = $length;
    }

    public function getDurability(): int
    {
        return $this->durability;
    }

    public function setDurability(int $durability): void
    {
        $this->durability = $durability;
    }

    public function getMinTemperature(): int
    {
        return $this->minTemperature;
    }

    public function setMinTemperature(int $minTemperature): void
    {
        $this->minTemperature = $minTemperature;
    }


}