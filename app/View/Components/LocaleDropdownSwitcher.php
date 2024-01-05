<?php

declare(strict_types=1);

namespace App\View\Components;

use Closure;
use HasLocaleInfo;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class LocaleDropdownSwitcher extends Component
{
    use HasLocaleInfo;
    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view(
            view: 'components.locale-dropdown-switcher',
            data: $this->getLocaleInfo(),
        );
    }
}
