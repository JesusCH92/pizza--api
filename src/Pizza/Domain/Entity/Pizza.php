<?php

namespace App\Pizza\Domain\Entity;

use App\Pizza\ApplicationService\DTO\PizzaUpdaterRequest;
use App\Pizza\Domain\ValueObject\Ingredients;
use App\Pizza\Domain\ValueObject\Name;
use DateTimeImmutable;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

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
