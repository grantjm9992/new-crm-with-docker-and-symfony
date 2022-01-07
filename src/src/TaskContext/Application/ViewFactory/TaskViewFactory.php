<?php

namespace App\TaskContext\Application\ViewFactory;

use App\ddd\Application\ViewFactory\AbstractViewFactory;
use App\TaskContext\Domain\Model\Task;
use App\TaskContext\Domain\ViewModel\TaskView;

class TaskViewFactory
{
    use AbstractViewFactory;

    public static function create(Task $task): TaskView
    {
        return new TaskView(
            $task->getTitle(),
            $task->getDescription(),
            $task->getTaskStatus(),
            $task->getUser(),
            $task->getCompany(),
            $task->getEntityReference(),
            $task->getNotes(),
            $task->getOrder()
        );
    }

}