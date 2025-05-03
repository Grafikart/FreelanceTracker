<?php

namespace App\Domains\Settings;

use App\Models\User;
use Carbon\CarbonImmutable;
use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;
use Illuminate\Support\Number;
use Symfony\Component\HttpFoundation\Response;

/**
 * Apply user settings for the request
 */
class SettingsMiddleware
{
    /**
     * Handle an incoming request.
     *
     * @param  \Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        $user = $request->user();
        if ($user instanceof User) {
            Number::useLocale($user->locale);
            CarbonImmutable::setLocale($user->locale);;
        } else {
            Number::useLocale(App::currentLocale());
            CarbonImmutable::setLocale(App::currentLocale());
        }

        return $next($request);
    }

}
