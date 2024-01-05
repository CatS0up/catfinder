<?php

declare(strict_types=1);

namespace App\Exceptions;

use Exception;
use Illuminate\Http\RedirectResponse;

class ContactNotificationException extends Exception
{
    public static function adminsNotFound(): self
    {
        return new self('No admins were found in system');
    }

    public function render(): RedirectResponse
    {
        return to_route('guest.contact.show')->with('info', __($this->message));
    }
}
