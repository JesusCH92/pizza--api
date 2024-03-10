<?php

declare(strict_types=1);

namespace App\Pizza\ApplicationService\DTO;

use DateTimeImmutable;

readonly class PizzaUpdaterResponse
{
    public array $ingredients;

    public function __construct(
        public int $id,
        public string $name,
        public ?int $ovenTimeInSeconds,
        public bool $isSpecial,
        public DateTimeImmutable $createdAt,
        public ?DateTimeImmutable $updatedAt,
        string ...$ingredients
    ) {
        $this->ingredients = $ingredients;
    }

    public function __serialize(): array
    {
        return [
            'id' => $this->id,
            'name' => $this->name,
            'oven_time_in_seconds' => $this->ovenTimeInSeconds,
            'is_special' => $this->isSpecial,
            'ingredients' => $this->ingredients,
            'created_at' => $this->createdAt->format('Y-m-d H:i:s'),
            'updated_at' => $this->updatedAt?->format('Y-m-d H:i:s'),
        ];
    }
}
