<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;
use Illuminate\Pagination\Paginator;
use App\Helpers\UnitHelper;
use App\Helpers\StatusHelper;
use App\Helpers\ColorHelper;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        app()->bind('unitHelper', function () {
            return new UnitHelper();
        });

        app()->bind('statusHelper', function () {
            return new StatusHelper();
        });

        app()->bind('colorHelper', function () {
            return new ColorHelper();
        });
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Paginator::useBootstrapFour();
    }
}
