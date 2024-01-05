<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

/** Auth Group - start */
Route::as('auth.')
    ->group(base_path('routes/auth.php'));
/** Auth Group - end */

/** Guest Group - start */
Route::middleware('guest')
    ->as('guest.')
    ->group(base_path('routes/guest.php'));
/** Guest Group - end */

/** User Group - start */
Route::middleware(['auth', 'verified'])
    ->as('user.')
    ->group(base_path('routes/user.php'));
/** User Group - end */

/** Admin Group - start */
Route::middleware(['auth', 'verified', 'role:admin', 'password.confirm'])
    ->as('admin.')
    ->prefix('admin')
    ->group(base_path('routes/admin.php'));
/** Admin Group - end */

/** Shared Group - start */
Route::as('shared.')
    ->group(base_path('routes/shared.php'));
/** Shared Group - end */
