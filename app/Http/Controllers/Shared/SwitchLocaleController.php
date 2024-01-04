<?php

declare(strict_types=1);

namespace App\Http\Controllers\Shared;

use App\Actions\Shared\SwitchLocaleAction;
use App\Http\Controllers\Controller;
use Illuminate\Http\RedirectResponse;

class SwitchLocaleController extends Controller
{
    public function __invoke(SwitchLocaleAction $action, string $locale): RedirectResponse
    {
        $action->handle($locale);

        return back();
    }
}
