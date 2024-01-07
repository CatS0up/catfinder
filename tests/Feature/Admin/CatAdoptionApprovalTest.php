<?php

declare(strict_types=1);

use App\Enums\CatStatus;
use App\Exceptions\Admin\AdoptionApproveException;
use App\Models\Cat;
use App\Models\User;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\from;
use function Pest\Laravel\patch;
use function Pest\Laravel\withoutExceptionHandling;

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

it('should redirect admin with warning when attempting to cancel adoption of cat with invalid status', function (CatStatus $invalidStatus): void {
    // Given
    withoutExceptionHandling();

    Role::create(['name' => 'admin']);
    $user = User::factory()->create();
    $user->syncRoles('admin');
    $cat = Cat::factory()->status($invalidStatus)->create();
    session(['auth.password_confirmed_at' => time()]);

    // When & Then
    from('/admin/dashboard')
        ->actingAs($user)
        ->patch("/admin/cats/{$cat->id}/cancel")
        ->assertRedirect('/admin/dashboard')
        ->assertSessionHas('warning', __('It is possible to approve the adoption of cats that have the status for approval'))
        ->assertSeeText(__('It is possible to approve the adoption of cats that have the status for approval'));

})->with([
    'available status' => CatStatus::Available,
    'adopted status' => CatStatus::Adopted,
])->throws(AdoptionApproveException::class);

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

it('should redirect admin with warning when attempting to approve adoption of cat with invalid status', function (CatStatus $invalidStatus): void {
    // Given
    withoutExceptionHandling();

    Role::create(['name' => 'admin']);
    $user = User::factory()->create();
    $user->syncRoles('admin');
    $cat = Cat::factory()->status($invalidStatus)->create();
    session(['auth.password_confirmed_at' => time()]);

    // When & Then
    from('/admin/dashboard')
        ->actingAs($user)
        ->patch("/admin/cats/{$cat->id}/approve")
        ->assertRedirect('/admin/dashboard')
        ->assertSessionHas('warning', __('It is possible to approve the adoption of cats that have the status for approval'))
        ->assertSeeText(__('It is possible to approve the adoption of cats that have the status for approval'));

})->with([
    'available status' => CatStatus::Available,
    'adopted status' => CatStatus::Adopted,
])->throws(AdoptionApproveException::class);

it('admin can cancel adoption', function (): void {
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
