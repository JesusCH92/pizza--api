<?php

declare(strict_types=1);

namespace App\Pizza\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Pizza\ApplicationService\DTO\PizzaUpdaterRequest;
use App\Pizza\ApplicationService\PizzaUpdater;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PizzaUpdaterController extends SymfonyApiController
{
    public function __construct(private readonly PizzaUpdater $pizzaUpdater)
    {
    }

    #[Route('/pizza-reorder', name: 'app_pizza_updater', methods: ['PATCH'])]
    public function pizzaUpdate(Request $request): JsonResponse
    {
        $requestBody = json_decode($request->getContent());

        $pizzaResponse = ($this->pizzaUpdater)(
            new PizzaUpdaterRequest(
                $requestBody->id,
                $requestBody->name,
                $requestBody->ovenTimeInSeconds,
                $requestBody->ingredients
            )
        );

        return new JsonResponse($pizzaResponse->__serialize(), Response::HTTP_ACCEPTED);
    }
}