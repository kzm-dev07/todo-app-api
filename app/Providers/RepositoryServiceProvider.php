<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use KzmTodoApp\Domain\Repositories\OidcProviderRepository;
use KzmTodoApp\Domain\Repositories\TaskRepository;
use KzmTodoApp\Domain\Repositories\WorkerRepository;
use KzmTodoApp\Infrastructure\Repositories\EloquentTaskRepository;
use KzmTodoApp\Infrastructure\Repositories\EloquentWorkerRepository;
use KzmTodoApp\Infrastructure\Repositories\RestOidcProviderRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OidcProviderRepository::class, RestOidcProviderRepository::class);
        $this->app->bind(WorkerRepository::class, EloquentWorkerRepository::class);
        $this->app->bind(TaskRepository::class, EloquentTaskRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
