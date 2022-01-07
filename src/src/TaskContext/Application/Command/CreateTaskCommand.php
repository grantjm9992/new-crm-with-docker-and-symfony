<?php

namespace App\TaskContext\Application\Command;

use App\ddd\CQRS\Command\Command;
use App\ddd\Domain\ValueObject\EntityReference;

class CreateTaskCommand implements Command
{
    private string $title;
    private ?string $description;
    private string $taskStatusId;
    private string $userId;
    private string $companyId;
    private ?EntityReference $entityReference;
    private string $notes;
    private ?int $order;

    public function __construct(
        string $title,
        ?string $description,
        string $taskStatusId,
        string $userId,
        string $companyId,
        ?EntityReference $entityReference,
        string $notes,
        ?int $order
    )
    {
        $this->title = $title;
        $this->description = $description;
        $this->taskStatusId = $taskStatusId;
        $this->userId = $userId;
        $this->companyId = $companyId;
        $this->entityReference = $entityReference;
        $this->notes = $notes;
        $this->order = $order;
    }

    /**
     * @return string
     */
    public function getTitle(): string
    {
        return $this->title;
    }

    /**
     * @return string|null
     */
    public function getDescription(): ?string
    {
        return $this->description;
    }

    /**
     * @return string
     */
    public function getTaskStatusId(): string
    {
        return $this->taskStatusId;
    }

    /**
     * @return string
     */
    public function getUserId(): string
    {
        return $this->userId;
    }

    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * @return EntityReference|null
     */
    public function getEntityReference(): ?EntityReference
    {
        return $this->entityReference;
    }

    /**
     * @return string
     */
    public function getNotes(): string
    {
        return $this->notes;
    }

    /**
     * @return int|null
     */
    public function getOrder(): ?int
    {
        return $this->order;
    }
}