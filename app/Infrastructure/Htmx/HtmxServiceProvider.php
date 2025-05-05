<?php

namespace App\Infrastructure\Htmx;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class HtmxServiceProvider extends ServiceProvider
{

    public function boot(): void
    {
        Blade::directive('htmxCsrf', fn () => "hx-headers='{\"X-CSRF-TOKEN\": \"<?= csrf_token() ?>\"}'" );
    }

}
