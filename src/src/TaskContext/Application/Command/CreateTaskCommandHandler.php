<?php

namespace App\TaskContext\Application\Command;

use App\CoreContext\Domain\Model\CompanyRepository;
use App\CoreContext\Domain\Model\UserRepository;
use App\ddd\CQRS\Command\CommandHandler;
use App\TaskContext\Domain\Model\Task;
use App\TaskContext\Domain\Model\TaskRepository;
use App\TaskContext\Domain\Model\TaskStatusRepository;
use Doctrine\ORM\EntityNotFoundException;

class CreateTaskCommandHandler implements CommandHandler
{
    private TaskRepository $taskRepository;
    private UserRepository $userRepository;
    private CompanyRepository $companyRepository;
    private TaskStatusRepository $taskStatusRepository;

    public function __construct(
        TaskRepository $taskRepository,
        UserRepository $userRepository,
        CompanyRepository $companyRepository,
        TaskStatusRepository $taskStatusRepository
    )
    {
        $this->taskRepository = $taskRepository;
        $this->userRepository = $userRepository;
        $this->companyRepository = $companyRepository;
        $this->taskStatusRepository = $taskStatusRepository;
    }

    public function __invoke(CreateTaskCommand $command)
    {
        $user = $this->userRepository->byId($command->getUserId());
        if ($user === null) {
            throw new EntityNotFoundException('User: ' . $command->getUserId());
        }

        $company = $this->companyRepository->byId($command->getCompanyId());
        if ($company === null) {
            throw new EntityNotFoundException('Company: ' . $command->getCompanyId());
        }

        $taskStatus = $this->taskStatusRepository->byId($command->getTaskStatusId());
        if ($taskStatus === null) {
            throw new EntityNotFoundException('TaskStatus: ' . $command->getTaskStatusId());
        }

        $task = new Task(
            $command->getTitle(),
            $command->getDescription(),
            $taskStatus,
            $user,
            $company,
            $command->getEntityReference(),
            $command->getNotes(),
            $command->getOrder()
        );

        $this->taskRepository->save($task);

        return $task;
    }
}