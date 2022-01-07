<?php

namespace App\TaskContext\Infrastructure\Controller;

use App\ddd\Domain\ValueObject\EntityReference;
use App\ddd\Infrastructure\Controller\BaseController;
use App\TaskContext\Application\Command\CreateTaskCommand;
use App\TaskContext\Application\Command\CreateTaskStatusCommand;
use App\TaskContext\Application\Query\FindTasksQuery;
use App\TaskContext\Application\Query\FindTaskStatusesQuery;
use App\TaskContext\Infrastructure\QueryParams\TaskQueryParams;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class TaskController extends BaseController
{
    /**
     * @Route("/companies/{companyId}/tasks", methods={"POST"})
     */
    public function create(string $companyId, Request $request): Response
    {
        $request = json_decode($request->getContent(), false);
        $command = new CreateTaskCommand(
            $request->title,
            $request->description,
            $request->taskStatusId,
            $request->userId,
            $companyId,
            $request->entityReferenceId ? new EntityReference($request->entityReferenceId, $request->entityReferenceType) : null,
            $request->notes,
            null
        );

        $this->commandBus->dispatch($command);

        return $this->emptyResponse();
    }

    /**
     * @Route("/companies/{companyId}/tasks", methods={"GET"})
     */
    public function list(string $companyId, Request $request): Response
    {
        $queryParams = TaskQueryParams::build($request->query->all());

        $query = new FindTasksQuery($queryParams);

        $response = $this->queryBus->handle($query);

        return $this->response($response);
    }
}