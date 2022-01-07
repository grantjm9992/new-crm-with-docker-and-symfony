<?php

namespace App\TaskContext\Infrastructure\Domain;

use App\ddd\Domain\ValueObject\EntityReference;
use App\ddd\Infrastructure\Domain\AbstractDoctrineRepository;
use App\TaskContext\Domain\Model\Task;
use App\TaskContext\Domain\Model\TaskRepository;
use App\TaskContext\Infrastructure\QueryParams\TaskQueryParams;
use Doctrine\Persistence\ManagerRegistry;

class TaskDoctrineRepository extends AbstractDoctrineRepository implements TaskRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass = Task::class)
    {
        parent::__construct($registry, $entityClass);
    }

    public function save(Task $task): void
    {
        $this->_em->persist($task);
    }

    public function byId(string $id): ?Task
    {
        return $this->find($id);
    }

    public function byUserId(string $userId): array
    {
        return [];
    }

    public function byEntityReference(EntityReference $entityReference): array
    {
        return [];
    }

    public function search(TaskQueryParams $queryParams)
    {
        $queryBuilder = $this->filter($queryParams);

        dd($queryBuilder->getQuery()->getResult());
    }
}