<?php

declare(strict_types=1);

namespace App\View\Components;

use App\View\Concerns\HasLocaleInfo as ConcernsHasLocaleInfo;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class ResponsiveLocaleSwitcher extends Component
{
    use ConcernsHasLocaleInfo;

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view(
            view: 'components.responsive-locale-switcher',
            data: $this->getLocaleInfo(),
        );
    }
}
