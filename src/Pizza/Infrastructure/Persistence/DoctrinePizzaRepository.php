<?php

declare(strict_types=1);

namespace App\Pizza\Infrastructure\Persistence;

use App\Common\Infrastructure\Persistence\DoctrineRepository;
use App\Pizza\Domain\Entity\Pizza;
use App\Pizza\Domain\Repository\PizzaRepository;

final class DoctrinePizzaRepository extends DoctrineRepository implements PizzaRepository
{
    public function save(Pizza $pizza): void
    {
        $this->entityManager()->persist($pizza);
        $this->entityManager()->flush();
    }
}