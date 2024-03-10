<?php

namespace App\Tests\Pizza\Canceler;

use App\Pizza\ApplicationService\PizzaCanceler;
use App\Pizza\Domain\Exception\NotFoundPizza;
use App\Tests\Pizza\StubPizzaRepository;
use PHPUnit\Framework\TestCase;

class PizzaCancelerTest extends TestCase
{
    /**
     * @test
     * @dataProvider pizzaCancelerRequest
     */
    public function throwNotFoundPizza(int $id)
    {
        $this->expectException(NotFoundPizza::class);

        $service = new PizzaCanceler(new StubPizzaRepository());
        $service($id);
    }

    /**
     * @test
     * @dataProvider pizzaCancelerRequest
     */
    public function shouldCanceledPizza(int $id)
    {
        $spy = new SpyPizzaRepository();

        $service = new PizzaCanceler($spy);
        $service($id);

        $this->assertTrue($spy->verify());
    }

    public function pizzaCancelerRequest(): array
    {
        return [
            [1],
            [2],
            [3],
            [4],
            [5],
            [6],
            [7],
            [8],
            [9],
            [10],
            [11],
            [12],
            [13],
            [14],
            [15],
            [16],
            [17],
            [18],
            [19],
            [20],
            [21],
        ];
    }
}