<?php

declare(strict_types=1);

use App\Http\Controllers\User\CatController;
use App\Http\Controllers\User\ProfileController;
use Illuminate\Support\Facades\Route;

/** Profile - start */
Route::prefix('profile')
    ->as('profile.')
    ->controller(ProfileController::class)
    ->group(function (): void {
        Route::get('/', 'edit')
            ->name('edit');

        Route::patch('/', 'update')
            ->name('update');

        Route::delete('/', 'destroy')
            ->name('destroy');
    });
/** Profile - end */

/** Cats - start */
Route::prefix('cats')
    ->resource('/cats', CatController::class);
/** Cats - end */
