<?php

declare(strict_types=1);

use App\Enums\CatStatus;
use App\Exceptions\AdoptionException;
use App\Models\Cat;
use App\Models\User;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\patch;
use function Pest\Laravel\withoutExceptionHandling;

it('guest user cannot choose cat for adoption', function (): void {
    // Given
    $cat = Cat::factory()->create();

    // When & Then
    patch("/cats/{$cat->id}/choose-for-adoption")
        ->assertRedirect('/login');
});

it('admin cannot choose cat for adoption', function (): void {
    // Given
    $user = User::factory()->create();
    Role::create(['name' => 'admin']);
    $user->syncRoles('admin');

    $cat = Cat::factory()->create();

    // When & Then
    actingAs($user)
        ->patch("/cats/{$cat->id}/choose-for-adoption")
        ->assertForbidden();
});

it('it should redirect user back with warning when cat has invalid status', function (CatStatus $invalidStatus): void {
    // Given
    withoutExceptionHandling();

    $user = User::factory()->create();
    Role::create(['name' => 'user']);
    $user->syncRoles('user');

    $cat = Cat::factory()->status($invalidStatus)->create();

    // When & Then
    actingAs($user)
        ->patch("/cats/{$cat->id}/choose-for-adoption")
        ->assertRedirect('/cats')
        ->assertSessionHas('warning', __('An error occurred while selecting a cat for adoption. Please try again later'))
        ->assertSeeText(__('An error occurred while selecting a cat for adoption. Please try again later'));

})->throws(AdoptionException::class)
    ->with([
        ['for_approval status' => CatStatus::ForApproval],
        ['adopted status' => CatStatus::Adopted],
    ]);

it('basic user can choose cat for adoption when cat has "available" status', function (): void {
    // Given
    $user = User::factory()->create();
    Role::create(['name' => 'user']);
    $user->syncRoles('user');

    $cat = Cat::factory()->status(CatStatus::Available)->create();

    // When & Then
    actingAs($user)
        ->patch("/cats/{$cat->id}/choose-for-adoption")
        ->assertRedirect('/cats')
        ->assertSessionHas('success', __('You have chosen a cat for adoption :cat now wait for the admin\'s consideration', ['cat' => $cat->name]));

    $cat->refresh();
    expect($cat->status)->toBe(CatStatus::ForApproval);
    expect($cat->adopter->id)->toBe($user->id);
});
