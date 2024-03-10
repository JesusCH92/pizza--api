<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Exception;

use Exception;
use Throwable;

final class InvalidPizzaName extends Exception
{
    public function __construct(string $message, int $code = 400, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}
