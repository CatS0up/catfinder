<?php

declare(strict_types=1);

use App\Http\Controllers\Shared\SwitchLocaleController;
use Illuminate\Support\Facades\Route;

Route::post('locale/{locale}', SwitchLocaleController::class)
    ->name('locale.switch');
