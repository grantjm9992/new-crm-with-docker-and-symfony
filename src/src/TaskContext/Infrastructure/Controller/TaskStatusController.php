<?php

namespace App\TaskContext\Infrastructure\Controller;

use App\ddd\Infrastructure\Controller\BaseController;
use App\TaskContext\Application\Command\CreateTaskStatusCommand;
use App\TaskContext\Application\Query\FindTaskStatusesQuery;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskStatusController extends BaseController
{
    /**
     * @Route("/companies/{companyId}/task-status", methods={"POST"})
     */
    public function create(string $companyId, Request $request): Response
    {
        $request = json_decode($request->getContent(), false);
        $command = new CreateTaskStatusCommand(
            $companyId,
            $request->name,
            $request->colour
        );

        $this->commandBus->dispatch($command);

        return $this->emptyResponse();
    }

    /**
     * @Route("/companies/{companyId}/task-status", methods={"GET"})
     */
    public function list(string $companyId): Response
    {
        $query = new FindTaskStatusesQuery($companyId);

        $response = $this->queryBus->handle($query);

        return $this->response($response);
    }
}