<?php

declare(strict_types=1);

namespace App\Pizza\ApplicationService;

use App\Pizza\ApplicationService\DTO\PizzaUpdaterRequest;
use App\Pizza\ApplicationService\DTO\PizzaUpdaterResponse;
use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Exception\NotFoundPizza;
use App\Pizza\Domain\Repository\PizzaRepository;

final class PizzaUpdater
{
    public function __construct(private readonly PizzaRepository $repository)
    {
    }

    public function __invoke(PizzaUpdaterRequest $request): PizzaUpdaterResponse
    {
        $pizza = $this->getPizzaOrFail($request->id);

        $pizza->updating($request);

        $this->repository->save($pizza);

        return new PizzaUpdaterResponse(
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