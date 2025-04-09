<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use KzmTodoApp\Domain\Common\JwtToken;
use KzmTodoApp\Domain\Common\Key;
use KzmTodoApp\Domain\Exceptions\NotFoundException;
use KzmTodoApp\Domain\Repositories\WorkerRepository;
use KzmTodoApp\Domain\Worker\Worker;
use Symfony\Component\HttpFoundation\Response;

class TokenMiddleware
{

    public function __construct(private readonly JwtToken $jwtToken, private readonly WorkerRepository $workerRepository) {}
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        try {
            $sub = $this->jwtToken->decode()->sub;
            $this->workerRepository->getWorker($sub);
        } catch (NotFoundException $e) {
            $worker = new Worker(
                Key::generate(),
                $sub,
            );
            $this->workerRepository->registerWorker($worker);
        }
        return $next($request);
    }
}
