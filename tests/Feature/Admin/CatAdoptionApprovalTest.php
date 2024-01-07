<?php

declare(strict_types=1);

use App\Enums\CatStatus;
use App\Models\Cat;
use App\Models\User;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\patch;

it('guest user cannot approve cat adoption', function (): void {
    // Given
    $cat = Cat::factory()->status(CatStatus::ForApproval)->create();

    // When & Then
    patch("/admin/cats/{$cat->id}/approve")
        ->assertRedirect('/login');
});
it('basic user cannot approve cat adoption', function (): void {
    // Given
    Role::create(['name' => 'user']);
    $user = User::factory()->create();
    $user->syncRoles('user');
    $cat = Cat::factory()->status(CatStatus::ForApproval)->create();

    // When & Then
    actingAs($user)
        ->patch("/admin/cats/{$cat->id}/approve")
        ->assertForbidden();
});
it('admin can approve cat adoption', function (): void {
    // Given
    Role::create(['name' => 'admin']);
    $user = User::factory()->create();
    $user->syncRoles('admin');
    $cat = Cat::factory()->status(CatStatus::ForApproval)->create();
    session(['auth.password_confirmed_at' => time()]);

    // When & Then
    actingAs($user)
        ->patch("/admin/cats/{$cat->id}/approve")
        ->assertSessionHas('success', __('The adoption of the cat :cat has been approved', ['cat' => $cat->name]));

    $cat->refresh();

    expect($cat->status)->toBe(CatStatus::Adopted);
});
it('guest user cannot cancel cat adoption', function (): void {
    // Given
    $cat = Cat::factory()->status(CatStatus::ForApproval)->create();

    // When & Then
    patch("/admin/cats/{$cat->id}/cancel")
        ->assertRedirect('/login');
});

it('basic user cannot cancel cat adoption', function (): void {
    // Given
    Role::create(['name' => 'user']);
    $user = User::factory()->create();
    $user->syncRoles('user');
    $cat = Cat::factory()->status(CatStatus::ForApproval)->create();

    // When & Then
    actingAs($user)
        ->patch("/admin/cats/{$cat->id}/cancel")
        ->assertForbidden();
});

it('admin can approve cancel adoption', function (): void {
    // Given
    Role::create(['name' => 'admin']);
    $user = User::factory()->create();
    $user->syncRoles('admin');
    $cat = Cat::factory()->status(CatStatus::ForApproval)->create();
    session(['auth.password_confirmed_at' => time()]);

    // When & Then
    actingAs($user)
        ->patch("/admin/cats/{$cat->id}/cancel")
        ->assertSessionHas('success', __('The adoption of the cat :cat has been cancelled', ['cat' => $cat->name]));

    $cat->refresh();

    expect($cat->status)->toBe(CatStatus::Available);
    expect($cat->adopter)->toBeNull();
});
