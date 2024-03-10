<?php

namespace App\Tests\Pizza\Canceler;

use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Repository\PizzaRepository;
use App\Tests\Common\Spy;

class SpyPizzaRepository extends Spy implements PizzaRepository
{
    public function save(Pizza $pizza): void
    {
    }

    public function findById(int $id): ?Pizza
    {
        $ingredients = ['ingredient_1'];

        return new Pizza('pizza_test', null, false, ...$ingredients);
    }

    public function delete(Pizza $pizza): void
    {
        $this->vadilateWasCalled = true;
    }
}