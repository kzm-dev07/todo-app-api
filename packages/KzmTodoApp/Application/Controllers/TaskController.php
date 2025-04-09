<?php

declare(strict_types=1);

namespace KzmTodoApp\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use KzmTodoApp\Application\Responses\TasksResponse;
use KzmTodoApp\Application\UseCases\CreateTask;
use KzmTodoApp\Application\UseCases\DeleteTask;
use KzmTodoApp\Application\UseCases\GetTasks;
use KzmTodoApp\Application\UseCases\UpdateTask;
use KzmTodoApp\Domain\Common\Key;

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
        $useCase($request->title, $request->isDone ?? false);
        return response()->json([], Response::HTTP_OK, []);
    }

    public function delete(Request $request, DeleteTask $useCase)
    {
        $useCase(new Key($request->key));

        return response()->json([], Response::HTTP_OK, []);
    }

    public function update(Request $request, UpdateTask $useCase)
    {
        $useCase(new Key($request->key), $request->title, $request->isDone);

        return response()->json([], Response::HTTP_OK, []);
    }
}
