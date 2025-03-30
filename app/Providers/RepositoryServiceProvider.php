<?php

declare(strict_types=1);

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use KzmTodoApp\Domain\Repositories\OidcProviderRepository;
use KzmTodoApp\Infrastructure\Repositories\RestOidcProviderRepository;

class RepositoryServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->bind(OidcProviderRepository::class, RestOidcProviderRepository::class);
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
