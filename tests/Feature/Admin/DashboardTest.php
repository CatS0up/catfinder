<?php

declare(strict_types=1);

use App\Enums\CatStatus;
use App\Models\Cat;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Role;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\get;

beforeEach(function (): void {
    session(['auth.password_confirmed_at' => time()]);
});

it('guest user cannot display dashboard', function (): void {
    // When & Then
    get('/admin/dashboard')
        ->assertRedirect('/login');
});

it('basic user cannot display dashboard', function (): void {
    // Given
    Role::create(['name' => 'user']);
    $user = User::factory()->create();

    $user->syncRoles('user');

    // When & Then
    actingAs($user)
        ->get('/admin/dashboard')
        ->assertForbidden();
});

it('admin user can display dashboard', function (): void {
    // Given
    Role::create(['name' => 'admin']);
    $user = User::factory()->create();
    $user->syncRoles('admin');

    // When & Then
    actingAs($user)
        ->get('/admin/dashboard')
        ->assertOk()
        ->assertViewIs('admin.dashboard');
});

it('admin user can display cat list for approval', function (): void {
    // Given
    Role::create(['name' => 'admin']);
    $user = User::factory()->create();
    $user->syncRoles('admin');

    $cats = Cat::factory(15)
        ->status(CatStatus::ForApproval)
        ->create();

    // When & Then
    actingAs($user)
        ->get('/admin/dashboard')
        ->assertOk()
        ->assertViewIs('admin.dashboard')
        ->assertSeeText($cats->pluck('name')->toArray());
});

it('admin user should see info when cat list for approval is empty', function (): void {
    // Given
    Role::create(['name' => 'admin']);
    $user = User::factory()->create();
    $user->syncRoles('admin');

    // When & Then
    actingAs($user)
        ->get('/admin/dashboard')
        ->assertSeeText(__('We do not currently have any cats for adoption'));
});

it('auth user can see 21 cats for approval per page', function (): void {
    // Given
    Role::create(['name' => 'admin']);
    $user = User::factory()->create();
    $user->syncRoles('admin');
    Cat::factory(42)
        ->status(CatStatus::ForApproval)
        ->create(['name' => 'kitty']);

    DB::table('cats')->update([
        'name' => DB::raw('name || " " || id'),
    ]);

    $cats = Cat::all();

    $firstPage = $cats->slice(0, 21);
    $secondPage = $cats->slice(21, 42);

    // When & Then

    expect($firstPage->count())->toBe(21);
    expect($secondPage->count())->toBe(21);
    actingAs($user)
        ->get('/admin/dashboard?page=1')
        ->assertOk()
        ->assertViewIs('admin.dashboard')
        ->assertSeeText($firstPage->pluck('name')->toArray())
        ->assertDontSeeText($secondPage->first()->name);

    actingAs($user)
        ->get('/admin/dashboard?page=2')
        ->assertOk()
        ->assertViewIs('admin.dashboard')
        ->assertSeeText($secondPage->pluck('name')->toArray())
        ->assertDontSeeText($firstPage->last()->name);
});
