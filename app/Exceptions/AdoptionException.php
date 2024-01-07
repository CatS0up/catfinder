<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class AdoptionException extends Exception
{
    public static function catHasInvalidStatus(): self
    {
        return new self('You can only adopt cats with the status of "available"');
    }

    public function render(): Response|RedirectResponse
    {
        return back()
            ->with('warning', __('An error occurred while selecting a cat for adoption. Please try again later'));
    }
}
