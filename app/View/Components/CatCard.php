<?php

declare(strict_types=1);

namespace App\View\Components;

use App\DataObjects\CatData;
use App\Models\Cat;
use Closure;
use Illuminate\Contracts\View\View;
use Illuminate\View\Component;

class CatCard extends Component
{
    /**
     * Create a new component instance.
     */
    public function __construct(
        public Cat|CatData $cat,
    ) {

    }

    /**
     * Get the view / contents that represent the component.
     */
    public function render(): View|Closure|string
    {
        return view('components.cat-card');
    }
}
