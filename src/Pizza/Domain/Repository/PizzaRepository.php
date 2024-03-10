<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Repository;

use App\Pizza\Domain\Entity\Pizza;

interface PizzaRepository
{
    public function save(Pizza $pizza): void;

    public function findById(int $id): ?Pizza;
}