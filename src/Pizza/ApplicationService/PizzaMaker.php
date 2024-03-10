<?php

declare(strict_types=1);

namespace App\Pizza\ApplicationService;

use App\Pizza\ApplicationService\DTO\PizzaMakerRequest;
use App\Pizza\ApplicationService\DTO\PizzaMakerResponse;
use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Repository\PizzaRepository;

final class PizzaMaker
{
    public function __construct(private readonly PizzaRepository $repository)
    {
    }

    public function __invoke(PizzaMakerRequest $request): PizzaMakerResponse
    {
        $pizza = new Pizza(
            $request->name,
            $request->ovenTimeInSeconds,
            $request->isSpecial,
            ...$request->ingredients
        );

        $this->repository->save($pizza);

        return new PizzaMakerResponse(
            $pizza->id(),
            $pizza->name()->value(),
            $pizza->ovenTimeInSeconds(),
            $pizza->special(),
            $pizza->createdAt(),
            ...$pizza->ingredients()->value()
        );
    }
}