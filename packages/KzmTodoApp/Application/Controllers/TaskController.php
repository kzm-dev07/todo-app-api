<?php

declare(strict_types=1);

namespace KzmTodoApp\Application\Controllers;

use Illuminate\Http\Request;
use Illuminate\Http\Response;
use KzmTodoApp\Application\UseCases\CreateTask;

class TaskController extends Controller
{
    public function create(Request $request, CreateTask $useCase)
    {
        $useCase($request->title, $request->isDone);
        return response()->json([], Response::HTTP_OK, []);
    }
}
