<?php

namespace App\Providers;

use App\Services\Seo\BreadcrumbsContainer;
use App\Services\Seo\MetaDataAccessor;
use Illuminate\Support\ServiceProvider;

class FacadeServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     */
    public function register(): void
    {
        $this->app->bind('seo.breadcrumbs', fn () => new BreadcrumbsContainer());
        $this->app->bind('seo.metadata', fn () => new MetaDataAccessor());
    }

    /**
     * Bootstrap services.
     */
    public function boot(): void
    {
        //
    }
}
