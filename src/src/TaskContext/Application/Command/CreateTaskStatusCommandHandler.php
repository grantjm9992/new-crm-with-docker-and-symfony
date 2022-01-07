<?php

namespace App\TaskContext\Application\Command;

use App\ddd\CQRS\Command\CommandHandler;
use App\TaskContext\Domain\Model\TaskStatus;
use App\TaskContext\Domain\Model\TaskStatusRepository;

class CreateTaskStatusCommandHandler implements CommandHandler
{
    private TaskStatusRepository $taskStatusRepository;

    public function __construct(TaskStatusRepository $taskStatusRepository)
    {
        $this->taskStatusRepository = $taskStatusRepository;
    }

    public function __invoke(CreateTaskStatusCommand $command): TaskStatus
    {
        $taskStatus = new TaskStatus(
            $command->getCompanyId(),
            $command->getName(),
            $command->getColour()
        );

        $this->taskStatusRepository->save($taskStatus);

        return $taskStatus;
    }
}