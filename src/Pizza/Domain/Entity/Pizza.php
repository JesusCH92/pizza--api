<?php

namespace App\Pizza\Domain\Entity;

use ApiPlatform\Metadata\ApiResource;
use ApiPlatform\Metadata\Delete;
use ApiPlatform\Metadata\Get;
use ApiPlatform\Metadata\Patch;
use ApiPlatform\Metadata\Post;
use App\Pizza\ApplicationService\DTO\PizzaGetterResponse;
use App\Pizza\ApplicationService\DTO\PizzaMakerRequest;
use App\Pizza\ApplicationService\DTO\PizzaMakerResponse;
use App\Pizza\ApplicationService\DTO\PizzaUpdaterRequest;
use App\Pizza\ApplicationService\DTO\PizzaUpdaterResponse;
use App\Pizza\Domain\ValueObject\Ingredients;
use App\Pizza\Domain\ValueObject\Name;
use App\Pizza\Infrastructure\Api\PizzaCancelerController;
use App\Pizza\Infrastructure\Api\PizzaController;
use App\Pizza\Infrastructure\Api\PizzaMakerController;
use App\Pizza\Infrastructure\Api\PizzaUpdaterController;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ApiResource(operations: [
    new Get(
        uriTemplate: '/pizza/{id}',
        controller: PizzaController::class,
        openapiContext: [
            'summary' => 'Obtiene una pizza por su ID',
            'description' => 'Recupera los detalles de una pizza específica usando su ID único.',
        ],
        output: PizzaGetterResponse::class,
        name: 'app_find_pizza_by_id'
    ),
    new Post(
        uriTemplate: '/pizza-maker',
        controller: PizzaMakerController::class,
        openapiContext: [
            'summary' => 'Creación de una pizza',
            'description' => 'Datos base para crear una pizza.',
        ],
        input: PizzaMakerRequest::class,
        output: PizzaMakerResponse::class,
        name: 'app_pizza_maker'
    ),
    new Patch(
        uriTemplate: '/pizza-reorder',
        controller: PizzaUpdaterController::class,
        openapiContext: [
            'summary' => 'Reeordenamos la pizza',
            'description' => 'Actualizamos la pizza según su ID.',
        ],
        input: PizzaUpdaterRequest::class,
        output: PizzaUpdaterResponse::class,
        name: 'app_pizza_updater'
    ),
    new Delete(
        uriTemplate: '/pizza-canceled/{id}',
        controller: PizzaCancelerController::class,
        openapiContext: [
            'summary' => 'Eliminamos la pizza',
            'description' => 'Eliminamos la pizza según su ID.',
            'responses' => [
                '204' => [
                    'description' => 'La pizza se eliminó correctamente',
                    'content' => [
                        'application/json' => [
                            'schema' => [
                                'type' => 'object',
                                'properties' => [
                                    'message' => [
                                        'type' => 'string',
                                        'example' => 'Se eliminó el recurso con id: 1',
                                    ],
                                ],
                            ],
                        ],
                    ],
                ],
            ],
        ],
        name: 'app_pizza_deleter'
    )
])]
#[ORM\Entity]
#[ORM\Table(name: 'pizza')]
class Pizza
{
    #[ORM\Id]
    #[ORM\GeneratedValue]
    #[ORM\Column]
    private ?int $id = null;

    #[ORM\Embedded(class: Name::class, columnPrefix: false)]
    private Name $name;

    #[ORM\Embedded(class: Ingredients::class, columnPrefix: false)]
    private Ingredients $ingredients;

    #[ORM\Column(name: 'oven_time_in_seconds', type: Types::INTEGER, nullable: true)]
    private ?int $ovenTimeInSeconds;

    #[ORM\Column(
        name: 'created_at',
        type: Types::DATETIME_IMMUTABLE,
        nullable: false,
        options: ['default' => 'CURRENT_TIMESTAMP']
    )]
    private DateTimeImmutable $createdAt;

    #[ORM\Column(name: 'updated_at', type: Types::DATETIME_IMMUTABLE, nullable: true)]
    private ?DateTimeImmutable $updatedAt = null;

    #[ORM\Column(name: 'special', type: Types::BOOLEAN, nullable: false)]
    private bool $special;

    public function __construct(string $name, ?int $ovenTimeInSeconds, bool $special, string ...$ingredients)
    {
        $this->name = new Name($name);
        $this->ovenTimeInSeconds = $ovenTimeInSeconds;
        $this->special = $special;
        $this->ingredients = new Ingredients(...$ingredients);
        $this->createdAt = new DateTimeImmutable();
    }

    public function id(): ?int
    {
        return $this->id;
    }

    public function name(): Name
    {
        return $this->name;
    }

    public function ingredients(): Ingredients
    {
        return $this->ingredients;
    }

    public function ovenTimeInSeconds(): ?int
    {
        return $this->ovenTimeInSeconds;
    }

    public function createdAt(): DateTimeImmutable
    {
        return $this->createdAt;
    }

    public function updatedAt(): ?DateTimeImmutable
    {
        return $this->updatedAt;
    }

    public function special(): bool
    {
        return $this->special;
    }

    public function updating(PizzaUpdaterRequest $dto): void
    {
        $this->name = new Name($dto->name);
        $this->ovenTimeInSeconds = $dto->ovenTimeInSeconds;
        $this->ingredients = new Ingredients(...$dto->ingredients);
        $this->updatedAt = new DateTimeImmutable();
    }
}
