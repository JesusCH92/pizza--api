<?php

namespace App\Tests\Pizza\Maker;

use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Repository\PizzaRepository;
use App\Tests\Common\Spy;

class SpyPizzaRepository extends Spy implements PizzaRepository
{
    private ?Pizza $savedPizza = null;

    public function save(Pizza $pizza): void
    {
        $this->vadilateWasCalled = true;
        $this->savedPizza = $pizza;
    }

    public function getLastSavedPizza(): ?Pizza
    {
        return $this->savedPizza;
    }

    public function findById(int $id): ?Pizza
    {
        return null;
    }

    public function delete(Pizza $pizza): void
    {
    }
}