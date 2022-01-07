<?php

namespace App\TaskContext\Application\Command;

use App\ddd\CQRS\Command\Command;

class CreateTaskStatusCommand implements Command
{
    private string $companyId;
    private string $name;
    private string $colour;

    public function __construct(
        string $companyId,
        string $name,
        string $colour
    )
    {
        $this->companyId = $companyId;
        $this->name = $name;
        $this->colour = $colour;
    }

    /**
     * @return string
     */
    public function getCompanyId(): string
    {
        return $this->companyId;
    }

    /**
     * @return string
     */
    public function getName(): string
    {
        return $this->name;
    }

    /**
     * @return string
     */
    public function getColour(): string
    {
        return $this->colour;
    }
}