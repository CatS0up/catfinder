<?php

declare(strict_types=1);

namespace App\Actions\Shared;

use Illuminate\Session\Store;

final class SwitchLocaleAction
{
    public function __construct(private Store $session)
    {

    }

    public function handle(string $locale): void
    {
        if ($this->isLocaleAvailable($locale)) {
            app()->setLocale($locale);
            $this->session->put('locale', $locale);
        }
    }

    private function isLocaleAvailable(string $locale): bool
    {
        /** @var array<string, string> */
        $availableLocales = config('app.available_locales');
        return in_array($locale, $availableLocales);
    }
}
