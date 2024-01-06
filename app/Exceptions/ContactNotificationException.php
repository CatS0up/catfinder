<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Response;

class ContactNotificationException extends Exception
{
    public static function adminsNotFound(): self
    {
        return new self('No admins were found in system');
    }

    public function render(): Response|RedirectResponse
    {
        return to_route('guest.contact.show')
            ->with('warning', __('An unknown error occurred while sending the message, please try again later'));
    }
}
