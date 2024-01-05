<?php

declare(strict_types=1);

namespace App\View\Concerns;

trait HasLocaleInfo
{
    /** @return array<string, mixed> */
    private function getLocaleInfo(): array
    {
        $currentLocaleCode = app()->getLocale();
        /** @var array<string, string> */
        $availableLocales = config('app.available_locales');
        $currentLocaleName = data_get(
            target: array_flip($availableLocales),
            key: $currentLocaleCode,
            default: config('app.fallback_locale'),
        );

        return compact('currentLocaleCode', 'currentLocaleName', 'availableLocales');
    }
}
