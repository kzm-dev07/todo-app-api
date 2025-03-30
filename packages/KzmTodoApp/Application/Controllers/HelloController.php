<?php

namespace KzmTodoApp\Application\Controllers;

use Illuminate\Http\Request;

class HelloController extends Controller
{
    public function index(Request $request)
    {
        return 'Hello world from Controller.';
    }
}
