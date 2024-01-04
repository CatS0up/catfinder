<?php

declare(strict_types=1);

namespace App\Http\Controllers\Guest;

use App\Http\Controllers\Controller;
use Illuminate\Contracts\View\View;

class ContactController extends Controller
{
    public function show(): View
    {
        return view('guest.contact');
    }

    public function send(): void
    {
        // TODO: Logic
    }
}
