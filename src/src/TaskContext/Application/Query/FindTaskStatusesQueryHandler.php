<?php

namespace App\TaskContext\Application\Query;

use App\ddd\CQRS\Query\QueryHandler;
use App\TaskContext\Application\ViewFactory\TaskStatusViewFactory;
use App\TaskContext\Domain\Model\TaskStatusRepository;

class FindTaskStatusesQueryHandler implements QueryHandler
{
    private TaskStatusRepository $taskStatusRepository;

    public function __construct(TaskStatusRepository $taskStatusRepository)
    {
        $this->taskStatusRepository = $taskStatusRepository;
    }

    public function __invoke(FindTaskStatusesQuery $query): array
    {
        $taskStatuses = $this->taskStatusRepository->byCompanyId($query->getCompanyId());

        return TaskStatusViewFactory::createCollection($taskStatuses);
    }
}