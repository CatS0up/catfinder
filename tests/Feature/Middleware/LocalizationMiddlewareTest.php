<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\get;

it('should default to config locale when no locale is assigned in session', function (string $defaultLocale): void {
    // Given
    Config::set('app.locale', $defaultLocale);
    Route::get('/dummy-test-route', fn (): string => 'Dummy info from dummy route')
        ->middleware(['web']); // Localization middleware is in the "web" group

    // When & Then
    expect(session()->has('locale'))->toBeFalse();
    expect(app()->getLocale())->toBe($defaultLocale);

    get('/dummy-test-route');

    expect(session()->has('locale'))->toBeFalse();
    expect(app()->getLocale())->toBe($defaultLocale);
})->with(['pl', 'en']);

it('should disregard session locale if route is within admin layer', function (): void {
    // Given
    Config::set('app.admin_locale', 'en');

    session()->put('locale', 'pl');

    Route::get('/admin', fn (): string => 'test')->middleware('web');

    // When & Then
    get('/admin')
        ->assertSessionHas('locale', 'pl');

    expect(app()->getLocale())->toBe('en');
});

it('should apply admin config locale if route is within admin layer', function (): void {
    Config::set('app.locale', 'pl');
    Config::set('app.admin_locale', 'en');

    Route::get('/admin', fn (): string => 'test')->middleware('web');
    Route::get('/test', fn (): string => 'test')->middleware('web')->name('admin.test');

    // When & Then
    get('/admin');
    expect(app()->getLocale())->toBe('en');

    Config::set('app.locale', 'pl');

    get('/test');
    expect(app()->getLocale())->toBe('en');
});

it('should not store locale in session if route switches to admin layer', function (): void {
    // Given
    Config::set('app.locale', 'pl');
    Config::set('app.admin_locale', 'en');

    Route::get('/admin', fn (): string => 'test')->middleware('web');

    // When & Then
    get('/admin')
        ->assertSessionMissing('locale');
});

it('should use session locale when one is assigned', function (string $from, string $to): void {
    // Given
    Route::get('/dummy-test-route', fn (): string => 'Dummy info from dummy route')->middleware(['web']); // Localization middleware is in the "web" group
    Config::set('app.locale', $from);
    session()->put('locale', $to);

    // When & Then
    expect(session()->get('locale'))->toBe($to);
    expect(app()->getLocale())->toBe($from);

    get('/dummy-test-route');

    expect(session()->get('locale'))->toBe($to);
    expect(app()->getLocale())->toBe($to);
})->with([
    'from Polish to English' => ['pl', 'en'],
    'from English to Polish' => ['en', 'pl'],
]);
