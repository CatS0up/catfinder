<?php

declare(strict_types=1);

use App\Http\Controllers\Guest\ContactController;
use Illuminate\Support\Facades\Route;

/** Home Page - start */
Route::view('/', 'guest.welcome')
    ->name('welcome');
/** Home Page - end */

/** Contact Page - start */
Route::prefix('contact')
    ->as('contact.')
    ->controller(ContactController::class)
    ->group(function (): void {
        Route::get('/', 'show')
            ->name('show');

        Route::post('/', 'send')
            ->middleware('throttle:contact')
            ->name('send');
    });
