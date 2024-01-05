<?php

declare(strict_types=1);

use App\Models\User;
use Spatie\Permission\Models\Role;

it('it should assign "user" role for new created user', function (): void {
    // When
    Role::create(['name' => 'user']);
    // dd(Role::whereName('user')->exists());
    $user = User::factory()->create();

    // Then
    expect($user->hasRole('user'))->toBeTrue();
});
