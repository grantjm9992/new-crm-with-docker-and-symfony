<?php

namespace App\TaskContext\Infrastructure\Domain;

use App\ddd\Infrastructure\Domain\AbstractDoctrineRepository;
use App\TaskContext\Domain\Model\TaskStatus;
use App\TaskContext\Domain\Model\TaskStatusRepository;
use Doctrine\Persistence\ManagerRegistry;

class TaskStatusDoctrineRepository extends AbstractDoctrineRepository implements TaskStatusRepository
{
    public function __construct(ManagerRegistry $registry, string $entityClass = TaskStatus::class)
    {
        parent::__construct($registry, $entityClass);
    }

    public function save(TaskStatus $taskStatus): void
    {
        $this->_em->persist($taskStatus);
    }

    public function byId(string $id): ?TaskStatus
    {
        return $this->find($id);
    }

    public function byCompanyId(string $companyId): array
    {
        return $this->queryBuilderList('taskStatus', $companyId)
            ->getQuery()
            ->getResult();
    }
}