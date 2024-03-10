<?php

declare(strict_types=1);

namespace App\Pizza\ApplicationService\DTO;

readonly class PizzaMakerRequest
{
    public function __construct(
        public string $name,
        public ?int $ovenTimeInSeconds,
        public bool $isSpecial,
        public array $ingredients
    ) {
    }
}
