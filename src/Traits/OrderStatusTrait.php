<?php

namespace App\Traits;

trait OrderStatusTrait
{
    public string $created = 'created';
    public string $inProgress = 'in_progress';
    public string $completed = 'completed';
}