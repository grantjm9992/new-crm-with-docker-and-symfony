<?php

namespace App\TaskContext\Application\Query;

use App\ddd\CQRS\Query\QueryHandler;
use App\TaskContext\Domain\Model\TaskRepository;

class FindTasksQueryHandler implements QueryHandler
{
    private TaskRepository $taskRepository;

    public function __construct(TaskRepository $taskRepository)
    {
        $this->taskRepository = $taskRepository;
    }

    public function __invoke(FindTasksQuery $query)
    {
        $this->taskRepository->search($query->getQueryParams());
    }
}