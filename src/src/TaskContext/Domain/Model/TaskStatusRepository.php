<?php

namespace App\TaskContext\Domain\Model;

interface TaskStatusRepository
{
    public function save(TaskStatus $taskStatus): void;

    public function byId(string $id): ?TaskStatus;

    public function byCompanyId(string $companyId): array;
}