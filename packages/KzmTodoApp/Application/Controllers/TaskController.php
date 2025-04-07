<?php

declare(strict_types=1);

namespace KzmTodoApp\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use KzmTodoApp\Application\Responses\TasksResponse;
use KzmTodoApp\Application\UseCases\CreateTask;
use KzmTodoApp\Application\UseCases\GetTasks;

class TaskController extends Controller
{
    public function index(GetTasks $useCase)
    {
        $tasks = $useCase();
        $response = TasksResponse::fromDomain($tasks);

        return response()->json($response, Response::HTTP_OK, []);
    }
    public function create(Request $request, CreateTask $useCase)
    {
        $useCase($request->title, $request->isDone);
        return response()->json([], Response::HTTP_OK, []);
    }
}
