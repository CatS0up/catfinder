<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CatApprovalController;
use App\Http\Controllers\Admin\CatController;
use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

/** Cat Approval - start */
Route::prefix('cats')
    ->as('cats.approve.')
    ->controller(CatApprovalController::class)
    ->group(function (): void {
        Route::get('/for-approval', 'index')
            ->name('index');
        Route::get('/{cat}/approve', 'show')
            ->name('show');
        Route::patch('/{cat}/accept', 'accept')
            ->name('accept');
        Route::patch('/{cat}/reject', 'reject')
            ->name('reject');
    });
/** Cat Approval - end */
