<?php

namespace App\Providers;

use App\Repositories\DestinationRepository;
use App\Repositories\QuoteRepository;
use App\Repositories\SiteRepository;
use App\Services\TemplateManagerService;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        $this->app->singleton(TemplateManagerService::class, function ($app) {
            return new TemplateManagerService(
                $app->make(QuoteRepository::class),
                $app->make(DestinationRepository::class),
                $app->make(SiteRepository::class),
            );
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
