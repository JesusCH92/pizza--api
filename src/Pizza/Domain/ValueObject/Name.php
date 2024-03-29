<?php

declare(strict_types=1);

namespace App\Pizza\Domain\ValueObject;

use App\Common\Domain\ValueObject\StringValueObject;
use App\Pizza\Domain\Exception\InvalidPizzaName;
use Doctrine\DBAL\Types\Types;
use Doctrine\ORM\Mapping as ORM;

#[ORM\Embeddable]
class Name extends StringValueObject
{
    const LENGTH_MAX = 48;

    #[ORM\Column(name: 'name', type: Types::STRING, length: 48, nullable: false)]
    protected ?string $value;

    protected function saveIfIsAllowed(?string $value): void
    {
        if (in_array($value, ['', null], true)) {
            throw new InvalidPizzaName('Name is required');
        }

        if (strlen($value) > self::LENGTH_MAX) {
            throw new InvalidPizzaName(sprintf('%s is greater than %s characters', $value, self::LENGTH_MAX));
        }
    }
}
