<?php

namespace App\TaskContext\Domain\Model;

use App\ddd\Domain\ValueObject\EntityReference;
use App\TaskContext\Infrastructure\QueryParams\TaskQueryParams;

interface TaskRepository
{
    public function save(Task $task): void;

    public function byId(string $id): ?Task;

    public function byUserId(string $userId): array;

    public function byEntityReference(EntityReference $entityReference): array;

    public function search(TaskQueryParams $queryParams);
}