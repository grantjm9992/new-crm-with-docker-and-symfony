<?php

namespace App\CoreContext\Infrastructure\Controller;

use App\ddd\Infrastructure\Controller\BaseController;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\Response;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends BaseController
{
    /**
     * @Route("/companies/{companyId}/users", methods={"GET"})
     */
    public function list(string $companyId, Request $request): Response
    {

    }


    /**
     * @Route("/companies/{companyId}/users", methods={"POST"})
     */
    public function create(string $companyId, Request $request): Response
    {

    }


    /**
     * @Route("/users/{userId}", methods={"PUT"})
     */
    public function update(string $userId, Request $request): Response
    {

    }
}