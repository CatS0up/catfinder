<?php

declare(strict_types=1);

use Illuminate\Support\Facades\Config;
use Illuminate\Support\Facades\Route;

use function Pest\Laravel\from;
use function Pest\Laravel\post;

it('should use default locale when given locale is not available', function (): void {
    // Given
    Config::set('app.locale', 'en');

    // When & Then
    post('/local/de')
        ->assertSessionMissing('locale');

    expect(app()->getLocale())->toBe('en');
});

it('should switch locale and redirect to previous page', function (): void {
    // Given
    Config::set('app.locale', 'en');
    session()->put('locale', 'en');
    Route::get('/test', fn (): string => 'Dummy info from dummy route')
        ->middleware(['web']);

    // When & Then
    from('/test')
        ->post('/locale/pl')
        ->assertRedirect('/test')
        ->assertSessionHas('locale', 'pl');

    expect(app()->getLocale())->toBe('pl');
});
