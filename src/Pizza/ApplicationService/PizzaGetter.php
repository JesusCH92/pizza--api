<?php

declare(strict_types=1);

namespace App\Pizza\ApplicationService;

use App\Pizza\ApplicationService\DTO\PizzaGetterResponse;
use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Exception\NotFoundPizza;
use App\Pizza\Domain\Repository\PizzaRepository;

final class PizzaGetter
{
    public function __construct(private readonly PizzaRepository $repository)
    {
    }

    public function __invoke(int $id): PizzaGetterResponse
    {
        $pizza = $this->getPizzaOrFail($id);

        return new PizzaGetterResponse(
            $pizza->id(),
            $pizza->name()->value(),
            $pizza->ovenTimeInSeconds(),
            $pizza->special(),
            $pizza->createdAt(),
            $pizza->updatedAt(),
            ...$pizza->ingredients()->value()
        );
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