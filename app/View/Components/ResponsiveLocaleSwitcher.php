<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResponsiveLocaleSwitcher extends Component
{
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        $currentLocaleCode = app()->getLocale();
        /** @var array<string, string> */
        $availableLocales = config('app.available_locales');
        $currentLocaleName = data_get(
            target: array_flip($availableLocales),
            key: $currentLocaleCode,
            default: config('app.fallback_locale'),
        );

        return view(
            view: 'components.responsive-locale-switcher',
            data: compact('currentLocaleCode', 'currentLocaleName', 'availableLocales')
        );
    }
}
