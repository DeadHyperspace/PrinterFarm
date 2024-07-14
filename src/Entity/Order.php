<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use DateTime;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\Common\Collections\Collection;
use Doctrine\ORM\Mapping as ORM;

#[
    ORM\Table(name: 'orders'),
    ORM\Entity(repositoryClass: OrderRepository::class)
]
class Order
{
    #[ORM\Id()]
    #[ORM\GeneratedValue(strategy: 'IDENTITY')]
    #[ORM\Column(name: 'id', type: 'integer')]
    private int $id;

    #[ORM\Column(name: 'created_at', type: 'datetime')]
    private DateTime $createdAt;

    #[ORM\Column(name: 'price', type: 'integer')]
    private int $price;

    #[ORM\Column(name: 'status', type: 'string')]
    private string $status;

    #[ORM\OneToMany(mappedBy: 'order', targetEntity: Model::class, cascade: ['persist'], fetch: 'EXTRA_LAZY')]
    private Collection $models;

    public function __construct()
    {
    }

    public function getId(): int
    {
        return $this->id;
    }

    public function setId(int $id): Order
    {
        $this->id = $id;
        return $this;
    }

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): Order
    {
        $this->createdAt = $createdAt;
        return $this;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): Order
    {
        $this->price = $price;
        return $this;
    }

    public function getStatus(): string
    {
        return $this->status;
    }

    public function setStatus(string $status): Order
    {
        $this->status = $status;
        return $this;
    }

    public function getModels(): Collection
    {
        return $this->models;
    }

    public function setModels(Collection $models): Order
    {
        $this->models = $models;
        return $this;
    }
}