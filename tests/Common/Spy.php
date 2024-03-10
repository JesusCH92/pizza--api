<?php

namespace App\Tests\Common;

abstract class Spy
{
    protected bool $vadilateWasCalled = false;

    public function verify(): bool
    {
        return $this->vadilateWasCalled;
    }
}