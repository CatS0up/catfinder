<?php

declare(strict_types=1);

use App\Actions\Shared\SwitchLocaleAction;
use Illuminate\Support\Facades\Config;

beforeEach(function (): void {
    $this->actionUnderTest = app()->make(SwitchLocaleAction::class);
});

it('should not switch locale if given locale is not supported', function ($locale): void {
    // Given
    Config::set('app.locale', 'pl');

    // When
    $this->actionUnderTest->handle($locale);
    $curentLocale = app()->getLocale();

    // Then
    expect($curentLocale)->not->toBe($locale);
    expect($curentLocale)->toBe('pl');
    expect(session()->has('locale'))->toBeFalse();

})->with(['es', 'fr', 'de']);

it('should switch locale if given locale is supported', function ($locale): void {
    // When
    $this->actionUnderTest->handle($locale);
    $curentLocale = app()->getLocale();

    // Then
    expect($curentLocale)->toBe($locale);
    expect(session()->has('locale'))->toBeTrue();
    expect(session()->get('locale'))->toBe($locale);

})->with(['pl', 'en']);
