<?php

namespace App\Providers;

use Illuminate\Http\Request;
use Illuminate\Support\ServiceProvider;
use KzmTodoApp\Domain\Common\JwtToken;
use KzmTodoApp\Domain\Common\KeyGenerator;
use KzmTodoApp\Domain\Repositories\OidcProviderRepository;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind('keyGenerator', KeyGenerator::class);
        app()->singleton(JwtToken::class, function ($app) {
            return new JwtToken($app->make(Request::class), $app->make(OidcProviderRepository::class));
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        //
    }
}
