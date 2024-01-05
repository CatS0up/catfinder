<?php

declare(strict_types=1);

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Symfony\Component\HttpFoundation\Response;

class Localization
{
    /**
     * Handle an incoming request.
     *
     * @param  Closure(\Illuminate\Http\Request): (\Symfony\Component\HttpFoundation\Response)  $next
     */
    public function handle(Request $request, Closure $next): Response
    {
        if ($this->isAdminRoute($request)) {
            /** @var string */
            $adminLocale = config('app.admin_locale');
            app()->setLocale($adminLocale);

            return $next($request);
        }

        /** @var string */
        $locale = session()->get('locale');
        if ($locale) {
            app()->setLocale($locale);
        }

        return $next($request);
    }

    private function isAdminRoute(Request $request): bool
    {
        return $request->is('admin*') || $request->routeIs('admin.*');
    }
}
