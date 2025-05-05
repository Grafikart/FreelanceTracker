<?php

namespace App\Infrastructure\I18n;

use Illuminate\Support\Facades\Blade;
use Illuminate\Support\ServiceProvider;

class I18nServiceProvider extends ServiceProvider
{

    public function boot()
    {
        Blade::directive('money', function (string $expression) {
            return sprintf("<?= new %s()->format(%s) ?>", MoneyFormatter::class, $expression);
        });
    }
}
