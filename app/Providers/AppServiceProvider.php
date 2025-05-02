<?php

namespace App\Providers;

use Carbon\CarbonImmutable;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Number;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {
        Number::useLocale(App::currentLocale());
        CarbonImmutable::setLocale(App::currentLocale());
        Paginator::defaultView('vendor.pagination.daisy-ui');
        Paginator::defaultSimpleView('vendor.pagination.daisy-ui');
    }
}
