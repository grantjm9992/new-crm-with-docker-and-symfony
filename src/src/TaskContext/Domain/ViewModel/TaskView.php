<?php

namespace App\TaskContext\Domain\ViewModel;

use App\CoreContext\Application\ViewFactory\CompanyViewFactory;
use App\CoreContext\Application\ViewFactory\UserViewFactory;
use App\CoreContext\Domain\Model\Company;
use App\CoreContext\Domain\Model\User;
use App\CoreContext\Domain\ViewModel\CompanyView;
use App\CoreContext\Domain\ViewModel\UserView;
use App\ddd\Domain\ValueObject\EntityReference;
use App\TaskContext\Application\ViewFactory\TaskStatusViewFactory;
use App\TaskContext\Domain\Model\TaskStatus;

class TaskView
{
    private string $title;
    private ?string $description;
    private TaskStatusView $taskStatus;
    private UserView $user;
    private CompanyView $company;
    private ?EntityReference $entityReference;
    private string $notes;
    private ?int $order;

    public function __construct(
        string $title,
        ?string $description,
        TaskStatus $taskStatus,
        User $user,
        Company $company,
        ?EntityReference $entityReference,
        string $notes,
        ?int $order
    )
    {

        $this->title = $title;
        $this->description = $description;
        $this->taskStatus = TaskStatusViewFactory::create($taskStatus);
        $this->user = UserViewFactory::create($user);
        $this->entityReference = $entityReference;
        $this->notes = $notes;
        $this->order = $order;
    }
}