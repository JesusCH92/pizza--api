<?php

namespace App\Tests\Pizza\Maker;

use App\Pizza\ApplicationService\DTO\PizzaMakerRequest;
use App\Pizza\ApplicationService\PizzaMaker;
use App\Pizza\Domain\Exception\InvalidPizzaName;
use App\Pizza\Domain\Exception\MaximumAmountExceeded;
use App\Tests\Pizza\StubPizzaRepository;
use PHPUnit\Framework\TestCase;

class PizzaMakerTest extends TestCase
{
    /**
     * @test
     * @dataProvider pizzaMakerRequest
     */
    public function throwInvalidPizzaName(?string $name, ?int $ovenTimeInSeconds, bool $isSpecial, array $ingredients)
    {
        $this->expectException(InvalidPizzaName::class);

        $service = new PizzaMaker(new StubPizzaRepository());
        $service(new PizzaMakerRequest($name, $ovenTimeInSeconds, $isSpecial, $ingredients));
    }

    /**
     * @test
     * @dataProvider pizzaMakerRequest2
     */
    public function throwMaximumAmountExceededIngredients(string $name, ?int $ovenTimeInSeconds, bool $isSpecial, array $ingredients)
    {
        $this->expectException(MaximumAmountExceeded::class);

        $service = new PizzaMaker(new StubPizzaRepository());
        $service(new PizzaMakerRequest($name, $ovenTimeInSeconds, $isSpecial, $ingredients));
    }

    /**
     * @test
     * @dataProvider pizzaMakerRequest3
     */
    public function shouldMakePizza(string $name, ?int $ovenTimeInSeconds, bool $isSpecial, array $ingredients)
    {
        $spy = new SpyPizzaRepository();

        $service = new PizzaMaker($spy);

        $service(new PizzaMakerRequest($name, $ovenTimeInSeconds, $isSpecial, $ingredients));

        $savedPizza = $spy->getLastSavedPizza();

        $this->assertTrue($spy->verify());
        $this->assertNotNull($savedPizza);
        $this->assertEquals($name, $savedPizza->name()->value());
        $this->assertEquals($ovenTimeInSeconds, $savedPizza->ovenTimeInSeconds());
        $this->assertEquals($isSpecial, $savedPizza->special());
    }

    public function pizzaMakerRequest(): array
    {
        return [
            [null, 10, true, ['ingredient_1', 'ingredient_2']],
            ['el7dF5cY2t0DtEtNc3xRTI6bzOEPPV5SpJ44kIngUnD7k3O9x', 1, true, ['ingredient_1', 'ingredient_2']],
            ['', 15, false, ['ingredient_1', 'ingredient_2']],
            [null, 1, true, ['ingredient_1', 'ingredient_2']],
            ['xyAkaHwAR0UdbvWkPu9d1JoepgckWp7PkRY7wuPiyLXoXu7Nr', 1, true, ['ingredient_1', 'ingredient_2']],
            [null, 1, true, ['ingredient_1', 'ingredient_2']],
            ['', 1, true, ['ingredient_1', 'ingredient_2']],
            ['', 1, true, ['ingredient_1', 'ingredient_2']],
            ['NISQTyXLXG9PGM0Crsg6CVtRMsVLgOlTR5oRLOnMiktsq21vT', 1, true, ['ingredient_1', 'ingredient_2']],
            ['t6vKrLtfovPo4WsE8rnZmEddJinwMWbre7rFclZaiVUcQ8aCN', 1, true, ['ingredient_1', 'ingredient_2']],
            ['', 1, true, ['ingredient_1', 'ingredient_2']],
            ['', null, true, ['ingredient_1', 'ingredient_2']],
            ['', 1, true, ['ingredient_1', 'ingredient_2']],
            ['fgE2WfwNVEbsbTERZRv7tzt4QSKU6RTB8mEzcJreJVpdY0Msq', 1, true, ['ingredient_1', 'ingredient_2']],
            [null, null, true, ['ingredient_1', 'ingredient_2']],
            ['3HiT3LteDDy4azXVxCUX2DuiRswFh67oMUMobW5oOnHOhGVfT', 1, true, ['ingredient_1', 'ingredient_2']],
            [null, 1, true, ['ingredient_1', 'ingredient_2']],
            ['', 1, true, ['ingredient_1', 'ingredient_2']],
            [null, 1, true, ['ingredient_1', 'ingredient_2']],
            ['ZvLBUmT6YDLreD0jAbyxBsaQgmwxcvmPFgp2yHDI1AwGjaY6R', 1, true, ['ingredient_1', 'ingredient_2']]
        ];
    }

    public function pizzaMakerRequest2(): array
    {
        $amountMinimIngredient = 21;
        $amountMaximumIngredient = 35;

        return [
            ['pizza_1', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_2', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_3', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_4', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_5', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_6', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_7', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_8', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_9', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_10', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_11', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_12', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_13', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_14', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_15', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_16', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_17', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_18', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_19', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_20', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
        ];
    }

    public function pizzaMakerRequest3(): array
    {
        $amountMinimIngredient = 0;
        $amountMaximumIngredient = 20;

        return [
            ['pizza_1', 1, false, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_2', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_3', 8, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_4', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_5', 13, false, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_6', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_7', 10, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_8', null, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_9', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_10', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_11', 5, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_12', null, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_13', 1, false, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_14', null, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_15', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_16', 9, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_17', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_18', 1, false, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_19', 12, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
            ['pizza_20', 1, true, $this->generateRandomIngredients($amountMinimIngredient, $amountMaximumIngredient)],
        ];
    }

    private function generateRandomIngredients(int $amountMinimIngredient, int $amountMaximumIngredient): array
    {
        $numIngredients = rand($amountMinimIngredient, $amountMaximumIngredient); // Genera un número aleatorio de ingredientes entre 21 y 35.
        $ingredients = [];

        for ($i = 1; $i <= $numIngredients; $i++) {
            $ingredients[] = 'ingredient_' . $i;
        }

        return $ingredients;
    }
}