<?php

declare(strict_types=1);

namespace App\Pizza\Domain\Exception;

use Exception;
use Throwable;

final class NotFoundPizza extends Exception
{
    public function __construct(string $message, int $code = 404, ?Throwable $previous = null)
    {
        parent::__construct($message, $code, $previous);
    }
}