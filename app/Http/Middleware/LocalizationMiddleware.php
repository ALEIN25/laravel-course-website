<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\App;

class LocalizationMiddleware
{
    public function handle(Request $request, Closure $next)
    {
        $locale = $request->segment(1); // Get the first segment of the URL

        if (!in_array($locale, config('app.locales'))) {
            $locale = config('app.fallback_locale');
        }

        App::setLocale($locale);

        $request->session()->put('locale', $locale);

        return $next($request);
    }
}


