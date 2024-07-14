<?php

namespace App\DTO;

use App\Entity\Model;
use Doctrine\Common\Collections\ArrayCollection;

class OrderRequestDTO
{
    /** @var ArrayCollection<ModelDTO>   */
    private ArrayCollection $model;

    public function __construct()
    {
    }

    public function getModel(): ArrayCollection
    {
        return $this->model;
    }

    public function setModel(ArrayCollection $model): void
    {
        $this->model = $model;
    }

}