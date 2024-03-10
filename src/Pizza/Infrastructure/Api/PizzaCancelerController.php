<?php

declare(strict_types=1);

namespace App\Pizza\Infrastructure\Api;

use App\Common\Infrastructure\Framework\SymfonyApiController;
use App\Pizza\ApplicationService\PizzaCanceler;
use Symfony\Component\HttpFoundation\JsonResponse;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

final class PizzaCancelerController extends SymfonyApiController
{
    public function __construct(private readonly PizzaCanceler $pizzaCanceler)
    {
    }

    #[Route('/pizza-canceled/{id}', name: 'app_pizza_deleter', methods: ['DELETE'])]
    public function pizzaCanceled(int $id): JsonResponse
    {
        ($this->pizzaCanceler)($id);

        return new JsonResponse(['message' => sprintf('pizza with ID: <%s>, was eliminated', $id)], Response::HTTP_NO_CONTENT);
    }
}