<?php

declare(strict_types=1);

namespace App\Common\Domain\ValueObject;

abstract class StringValueObject
{
    protected ?string $value;

    public function __construct(?string $value)
    {
        $this->setValue($value);
    }

    private function setValue(?string $value): void
    {
        $this->saveIfIsAllowed($value);
        $this->value = $value;
    }

    abstract protected function saveIfIsAllowed(?string $value): void;

    public function value(): ?string
    {
        return $this->value;
    }
}
