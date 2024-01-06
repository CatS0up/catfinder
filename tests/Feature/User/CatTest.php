<?php

declare(strict_types=1);

use App\Enums\CatStatus;
use App\Models\Cat;
use App\Models\User;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

it('guest user cannot display cat list', function (): void {
    // When & Then
    get('/cats')
        ->assertRedirect('/login');
});

it('auth user can display cat list', function (): void {
    // Given
    $user = User::factory()->create();
    $cats = Cat::factory(
        15
    )->status(CatStatus::Available)
        ->create();

    // When & Then
    actingAs($user)
        ->get('/cats')
        ->assertOk()
        ->assertViewIs('user.cats.index')
        ->assertSeeText($cats->pluck('name')->toArray());
});

it('auth user should see info when cat list is empty', function (): void {
    // Given
    $user = User::factory()->create();

    // When & Then
    actingAs($user)
        ->get('/cats')
        ->assertSeeText(__('We do not currently have any cats for adoption'));
});

it('auth user can see 21 cats per page', function (): void {
    // Given
    $user = User::factory()->create();
    $cats = Cat::factory(
        42
    )->status(CatStatus::Available)
        ->create();

    $firstPage = $cats->slice(0, 21);
    $secondPage = $cats->slice(21, 42);

    // When & Then

    expect($firstPage->count())->toBe(21);
    expect($secondPage->count())->toBe(21);
    actingAs($user)
        ->get('/cats?page=1')
        ->assertOk()
        ->assertViewIs('user.cats.index')
        ->assertSeeText($firstPage->pluck('name')->toArray())
        ->assertDontSeeText($secondPage->first()->name);

    actingAs($user)
        ->get('/cats?page=2')
        ->assertOk()
        ->assertViewIs('user.cats.index')
        ->assertSeeText($secondPage->pluck('name')->toArray())
        ->assertDontSeeText($firstPage->last()->name);
});
