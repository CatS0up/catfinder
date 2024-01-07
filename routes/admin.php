<?php

declare(strict_types=1);

use App\Http\Controllers\Admin\CatAdoptionApprovalController;
use Illuminate\Support\Facades\Route;

Route::view('/dashboard', 'admin.dashboard')->name('dashboard');

/** Cat Approval - start */
Route::prefix('cats')
    ->as('cats.approve.')
    ->controller(CatAdoptionApprovalController::class)
    ->group(function (): void {
        Route::get('/for-approval', 'index')
            ->name('index');
        Route::patch('/{cat}/approve', 'approve')
            ->name('approve');
        Route::patch('/{cat}/cancel', 'cancel')
            ->name('cancel');
    });
/** Cat Approval - end */
