<?php

namespace App\TaskContext\Domain\ViewModel;

class TaskStatusView
{
    public string $id;
    public string $companyId;
    public string $name;
    public string $colour;

    public function __construct(
        string $id,
        string $companyId,
        string $name,
        string $colour
    )
    {
        $this->id = $id;
        $this->companyId = $companyId;
        $this->name = $name;
        $this->colour = $colour;
    }
}