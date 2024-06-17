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
    #[ORM\ManyToOne(targetEntity: Order::class, fetch: 'EXTRA_LAZY', inversedBy: 'models')]
    #[ORM\JoinColumn(name: 'order_id', referencedColumnName: 'id', nullable: false,onDelete: 'RESTRICT')]
    protected Order $order;


    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Model
    {
        $this->id = $id;
        return $this;
    }

    public function getName(): string
    {
        return $this->name;
    }

    public function setName(string $name): Model
    {
        $this->name = $name;
        return $this;
    }

    public function getPlasticLength(): int
    {
        return $this->plasticLength;
    }

    public function setPlasticLength(int $plasticLength): Model
    {
        $this->plasticLength = $plasticLength;
        return $this;
    }

    public function getDurability(): int
    {
        return $this->durability;
    }

    public function setDurability(int $durability): Model
    {
        $this->durability = $durability;
        return $this;
    }

    public function getOrders(): Collection
    {
        return $this->orders;
    }

    public function setOrders(Collection $orders): Model
    {
        $this->orders = $orders;
        return $this;
    }


}