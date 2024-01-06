<?php

declare(strict_types=1);

namespace App\Http\Controllers\Guest;

use App\Actions\Guest\SendContactNotificationAction;
use App\Http\Controllers\Controller;
use App\Http\Requests\Guest\SendContactNotificationRequest;
use Illuminate\Contracts\View\View;
use Illuminate\Http\RedirectResponse;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('guest.contact');
    }

    public function send(SendContactNotificationRequest $request, SendContactNotificationAction $action): RedirectResponse
    {
        $action->handle($request->toDataObject());

        return back()
            ->with('info', __('Your message has been sent'));
    }
}
