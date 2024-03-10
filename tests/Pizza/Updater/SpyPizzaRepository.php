<?php

namespace App\Tests\Pizza\Updater;

use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Repository\PizzaRepository;
use App\Tests\Common\Spy;

class SpyPizzaRepository extends Spy implements PizzaRepository
{

    public function save(Pizza $pizza): void
    {
        $this->vadilateWasCalled = true;
    }

    public function findById(int $id): ?Pizza
    {
        $ingredients = ['ingredient_1'];

        return new Pizza('pizza_test', null, false, ...$ingredients);
    }

    public function delete(Pizza $pizza): void
    {
        // TODO: Implement delete() method.
    }
}