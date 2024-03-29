<?php

declare(strict_types=1);

namespace App\Common\Infrastructure\Persistence;

use Doctrine\ORM\EntityManagerInterface;
use Doctrine\Persistence\ObjectRepository;

abstract class DoctrineRepository
{
    public function __construct(private EntityManagerInterface $entityManager)
    {
    }

    protected function entityManager(): EntityManagerInterface
    {
        return $this->entityManager;
    }

    protected function repository(string $entityName): ObjectRepository
    {
        return $this->entityManager()->getRepository($entityName);
    }
}
