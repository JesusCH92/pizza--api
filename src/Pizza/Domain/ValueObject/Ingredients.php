<?php

declare(strict_types=1);

namespace App\Pizza\Domain\ValueObject;

use App\Pizza\Domain\Exception\MaximumAmountExceeded;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Ingredients
{
    const AMOUNT_MAX = 20;

    #[ORM\Column(name: 'ingredients', type: Types::JSON, nullable: false)]
    private array $ingredients;

    public function __construct(string ...$ingredients)
    {
        $this->setIngredients(...$ingredients);
    }

    private function setIngredients(string ...$ingredients): void
    {
        $this->saveIfIsAllowed(...$ingredients);
        $this->ingredients = array_unique($ingredients);
    }

    private function saveIfIsAllowed(string ...$ingredients): void
    {
        $amount = count($ingredients);

        if ($amount > self::AMOUNT_MAX) {
            throw new MaximumAmountExceeded(sprintf('%s is too many ingredients', $amount));
        }
    }

    public function value(): array
    {
        return $this->ingredients;
    }
}
