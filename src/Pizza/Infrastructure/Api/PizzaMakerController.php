<?php

declare(strict_types=1);

namespace App\Pizza\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Pizza\ApplicationService\DTO\PizzaMakerRequest;
use App\Pizza\ApplicationService\PizzaMaker;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PizzaMakerController extends SymfonyApiController
{
    public function __construct(private readonly PizzaMaker $pizzaMaker)
    {
    }

    #[Route('/pizza-maker', name: 'app_pizza_maker', methods: ['POST'])]
    public function pizzaMaker(Request $request): JsonResponse
    {
        $requestBody = json_decode($request->getContent());

        $pizzaResponse = ($this->pizzaMaker)(
            new PizzaMakerRequest(
                $requestBody->name,
                $requestBody->ovenTimeInSeconds,
                $requestBody->isSpecial,
                $requestBody->ingredients
            )
        );

        return new JsonResponse($pizzaResponse->__serialize(), Response::HTTP_CREATED);
    }
}
