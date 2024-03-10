<?php

declare(strict_types=1);

namespace App\Pizza\ApplicationService\DTO;

readonly class PizzaUpdaterRequest
{
    public function __construct(
        public int $id,
        public string $name,
        public ?int $ovenTimeInSeconds,
        public array $ingredients
    ) {
    }
}
