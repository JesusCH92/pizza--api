<?php

namespace App\DataFixtures;

use App\Pizza\ApplicationService\DTO\PizzaMakerRequest;
use App\Pizza\ApplicationService\PizzaMaker;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Persistence\ObjectManager;

class AppFixtures extends Fixture
{
    public function __construct(private readonly PizzaMaker $pizzaMaker)
    {
    }

    public function load(ObjectManager $manager): void
    {
        for($i = 0; $i < 20; $i++) {
            ($this->pizzaMaker)(
                new PizzaMakerRequest(
                    'pizza_' . $i,
                    null,
                    false,
                    ['ingredient_1', 'ingredient_2']
                )
            );
        }

        $manager->flush();
    }
}
