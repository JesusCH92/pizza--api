<?php

namespace App\Tests\Pizza;

use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Repository\PizzaRepository;

class StubPizzaRepository implements PizzaRepository
{
    public function save(Pizza $pizza): void
    {
    }

    public function findById(int $id): ?Pizza
    {
        return null;
    }

    public function delete(Pizza $pizza): void
    {
    }
}