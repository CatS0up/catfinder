<?php

declare(strict_types=1);

namespace App\Exceptions\Admin;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class AdoptionApproveException extends Exception
{
    public static function catHasInvalidStatus(): self
    {
        return new self('You can only aprove cats with the status of "for_approval"');
    }

    public function render(): Response|RedirectResponse
    {
        return back()
            ->with('warning', __('It is possible to approve the adoption of cats that have the status for approval'));
    }
}
