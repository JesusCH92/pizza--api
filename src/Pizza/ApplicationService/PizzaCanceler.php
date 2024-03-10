<?php

declare(strict_types=1);

namespace App\Pizza\ApplicationService;

use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Exception\NotFoundPizza;
use App\Pizza\Domain\Repository\PizzaRepository;

final class PizzaCanceler
{
    public function __construct(private readonly PizzaRepository $repository)
    {
    }

    public function __invoke(int $id): void
    {
        $pizza = $this->getPizzaOrFail($id);

        $this->repository->delete($pizza);
    }

    private function getPizzaOrFail(int $id): Pizza
    {
        $pizza = $this->repository->findById($id);

        if (null === $pizza) {
            throw new NotFoundPizza(sprintf('Not found id pizza with ID: <%s>', $id));
        }

        return $pizza;
    }
}