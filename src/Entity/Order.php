<?php

namespace App\Entity;

use App\Repository\OrderRepository;
use DateTime;
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
    private int $status;

    #[ORM\ManyToOne(targetEntity: Model::class, fetch: 'EXTRA_LAZY', inversedBy: 'orders')]
    #[ORM\JoinColumn(name: 'model_id', referencedColumnName: 'id', nullable: false)]
    private Model $model;

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

    public function getCreatedAt(): DateTime
    {
        return $this->createdAt;
    }

    public function setCreatedAt(DateTime $createdAt): void
    {
        $this->createdAt = $createdAt;
    }

    public function getPrice(): int
    {
        return $this->price;
    }

    public function setPrice(int $price): void
    {
        $this->price = $price;
    }

    public function getStatus(): int
    {
        return $this->status;
    }

    public function setStatus(int $status): void
    {
        $this->status = $status;
    }

    public function getModel(): Model
    {
        return $this->model;
    }

    public function setModel(Model $model): void
    {
        $this->model = $model;
    }
}