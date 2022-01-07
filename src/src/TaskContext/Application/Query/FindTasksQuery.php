<?php

namespace App\TaskContext\Application\Query;

use App\ddd\CQRS\Query\Query;
use App\TaskContext\Infrastructure\QueryParams\TaskQueryParams;

class FindTasksQuery implements Query
{
    private TaskQueryParams $queryParams;

    public function __construct(TaskQueryParams $queryParams)
    {
        $this->queryParams = $queryParams;
    }

    /**
     * @return TaskQueryParams
     */
    public function getQueryParams(): TaskQueryParams
    {
        return $this->queryParams;
    }
}