<?php

namespace App\Entity;

use App\Repository\ModelRepository;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Table(name: 'models'),
    ORM\Entity(repositoryClass: ModelRepository::class)
]

class Model
{
  #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'name', type: 'string')]
    private string $name;

    #[ORM\Column(name: 'plastic_length', type: 'integer')]
    private int $plasticLength;

    #[ORM\Column(name: 'durability', type: 'integer')]
    private int $durability;

    #[
        ORM\OneToMany(
            mappedBy: 'model',
            targetEntity: Order::class,
            cascade: ['persist'],
            fetch: 'EXTRA_LAZY'
        )]
    private Collection $orders;

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

    public function getPlasticLength(): int
    {
        return $this->plasticLength;
    }

    public function setPlasticLength(int $plasticLength): void
    {
        $this->plasticLength = $plasticLength;
    }

    public function getDurability(): int
    {
        return $this->durability;
    }

    public function setDurability(int $durability): void
    {
        $this->durability = $durability;
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function setOrders(Collection $orders): void
    {
        $this->orders = $orders;
    }
}