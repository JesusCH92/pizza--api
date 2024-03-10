<?php

namespace App\Tests\Pizza\Updater;

use App\Pizza\ApplicationService\DTO\PizzaUpdaterRequest;
use App\Pizza\ApplicationService\PizzaUpdater;
use App\Pizza\Domain\Exception\NotFoundPizza;
use App\Tests\Pizza\StubPizzaRepository;
use PHPUnit\Framework\TestCase;

class PizzaUpdaterTest extends TestCase
{
    /**
     * @test
     * @dataProvider pizzaUpdaterRequest
     */
    public function throwNotFoundPizza(int $id, string $name, ?int $ovenTimeInSeconds, array $ingredients)
    {
        $this->expectException(NotFoundPizza::class);

        $service = new PizzaUpdater(new StubPizzaRepository());
        $service(new PizzaUpdaterRequest($id, $name, $ovenTimeInSeconds, $ingredients));
    }

    /**
     * @test
     * @dataProvider pizzaUpdaterRequest
     */
    public function shouldUpdatePizza(int $id, string $name, ?int $ovenTimeInSeconds, array $ingredients)
    {
        $spy = new SpyPizzaRepository();

        $service = new PizzaUpdater($spy);
        $service(new PizzaUpdaterRequest($id, $name, $ovenTimeInSeconds, $ingredients));

        $this->assertTrue($spy->verify());
    }

    public function pizzaUpdaterRequest(): array
    {
        return [
            [3, 'pizza_1_actualizada', 2, ['ingredient_a_1', 'ingredient_b_1', 'ingredient_c_1']],
            [4, 'pizza_2_actualizada', 3, ['ingredient_a_2', 'ingredient_b_2', 'ingredient_c_2']],
            [5, 'pizza_3_actualizada', null, ['ingredient_a_3', 'ingredient_b_3', 'ingredient_c_3']],
            [6, 'pizza_4_actualizada', 1000, ['ingredient_a_4', 'ingredient_b_4', 'ingredient_c_4']],
            [7, 'pizza_5_actualizada', 5, ['ingredient_a_5', 'ingredient_b_5', 'ingredient_c_5']],
            [8, 'pizza_6_actualizada', 6, ['ingredient_a_6', 'ingredient_b_6', 'ingredient_c_6']],
            [9, 'pizza_7_actualizada', 7, ['ingredient_a_7', 'ingredient_b_7', 'ingredient_c_7']],
            [10, 'pizza_8_actualizada', 8, ['ingredient_a_8', 'ingredient_b_8', 'ingredient_c_8']],
            [11, 'pizza_9_actualizada', 9, ['ingredient_a_9', 'ingredient_b_9', 'ingredient_c_9']],
            [12, 'pizza_10_actualizada', 10, ['ingredient_a_10', 'ingredient_b_10', 'ingredient_c_10']],
            [13, 'pizza_11_actualizada', 11, ['ingredient_a_11', 'ingredient_b_11', 'ingredient_c_11']],
            [14, 'pizza_12_actualizada', 12, ['ingredient_a_12', 'ingredient_b_12', 'ingredient_c_12']],
            [15, 'pizza_13_actualizada', 15, ['ingredient_a_13', 'ingredient_b_13', 'ingredient_c_13']],
            [16, 'pizza_14_actualizada', 16, ['ingredient_a_14', 'ingredient_b_14', 'ingredient_c_14']],
            [17, 'pizza_15_actualizada', 17, ['ingredient_a_15', 'ingredient_b_15', 'ingredient_c_15']],
            [18, 'pizza_16_actualizada', 18, ['ingredient_a_16', 'ingredient_b_16', 'ingredient_c_16']],
            [19, 'pizza_17_actualizada', 19, ['ingredient_a_17', 'ingredient_b_17', 'ingredient_c_17']],
            [20, 'pizza_18_actualizada', 20, ['ingredient_a_18', 'ingredient_b_18', 'ingredient_c_18']],
            [21, 'pizza_19_actualizada', 21, ['ingredient_a_19', 'ingredient_b_19', 'ingredient_c_19']],
            [22, 'pizza_20_actualizada', 22, ['ingredient_a_20', 'ingredient_b_20', 'ingredient_c_20']]
        ];
    }
}