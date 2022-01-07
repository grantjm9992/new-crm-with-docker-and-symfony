<?php

namespace App\TaskContext\Application\ViewFactory;

use App\ddd\Application\ViewFactory\AbstractViewFactory;
use App\TaskContext\Domain\Model\TaskStatus;
use App\TaskContext\Domain\ViewModel\TaskStatusView;

class TaskStatusViewFactory
{
    use AbstractViewFactory;

    public static function create(TaskStatus $taskStatus): TaskStatusView
    {
        return new TaskStatusView(
            $taskStatus->getId(),
            $taskStatus->getCompanyId(),
            $taskStatus->getName(),
            $taskStatus->getColour()
        );
    }
}