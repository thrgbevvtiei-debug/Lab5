<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class SetLocale
{
    public function handle(Request $request, Closure $next): Response
    {
        $available = array_keys(config('locales'));
        $lang = $request->query('lang');

        // ?lang=en зберігаємо у сесії, щоб мова не губилась при переходах
        if ($lang !== null && in_array($lang, $available, true)) {
            session(['locale' => $lang]);
        }

        $locale = session('locale', config('app.locale'));

        if (! in_array($locale, $available, true)) {
            $locale = config('app.fallback_locale');
        }

        app()->setLocale($locale);

        return $next($request);
    }
}
