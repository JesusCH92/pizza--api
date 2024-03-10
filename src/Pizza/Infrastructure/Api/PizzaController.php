<?php

declare(strict_types=1);

namespace App\Pizza\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Pizza\ApplicationService\PizzaGetter;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PizzaController extends SymfonyApiController
{
    public function __construct(private readonly PizzaGetter $pizzaGetter)
    {
    }

    #[Route('/pizza/{id}', name: 'app_find_pizza_by_id', methods: ['GET'])]
    public function getPizza(int $id): JsonResponse
    {
        $pizzaResponse = ($this->pizzaGetter)($id);

        return new JsonResponse($pizzaResponse->__serialize(), Response::HTTP_OK);
    }
}