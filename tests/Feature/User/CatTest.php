<?php

declare(strict_types=1);

use App\Enums\CatGender;
use App\Enums\CatStatus;
use App\Models\Cat;
use App\Models\User;
use Illuminate\Support\Facades\DB;

use function Pest\Laravel\actingAs;
use function Pest\Laravel\assertDatabaseCount;
use function Pest\Laravel\assertModelExists;
use function Pest\Laravel\assertModelMissing;
use function Pest\Laravel\delete;
use function Pest\Laravel\get;
use function Pest\Laravel\post;
use function Pest\Laravel\put;

it('guest user cannot display cat list', function (): void {
    // When & Then
    get('/cats')->assertRedirect('/login');
});

it('auth user can display cat list', function (): void {
    // Given
    $user = User::factory()->create();
    $cats = Cat::factory(15)
        ->status(CatStatus::Available)
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
    Cat::factory(42)
        ->status(CatStatus::Available)
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

it('guest user cannot display cat show page', function (): void {
    // Given
    $cat = Cat::factory()->create();

    // When & Then
    get("/cats/{$cat->id}")
        ->assertRedirect('/login');
});

it('auth user can display cat show page', function (): void {
    // Given
    $user = User::factory()->create();
    $cat = Cat::factory()->create([
        'description' => '<b>Test</b>',
    ]);

    // When & Then
    actingAs($user)
        ->get("/cats/{$cat->id}")
        ->assertOk()
        ->assertViewIs('user.cats.show')
        ->assertSee($cat->image_url, false)
        ->assertSeeText($cat->name)
        ->assertSeeText($cat->age)
        ->assertSeeText($cat->gender->label())
        ->assertSeeText($cat->breed)
        ->assertSeeText(strip_tags($cat->description));
});

it('guest user cannot display cat create page', function (): void {
    // When & Then
    get('/cats/create')
        ->assertRedirect('/login');
});

it('auth user can display cat create page', function (): void {
    // Given
    $user = User::factory()->create();

    // When & Then
    actingAs($user)
        ->get("/cats/create")
        ->assertOk()
        ->assertViewIs('user.cats.create');
});

it('guest user cannot create cat', function (): void {
    // When & Then
    post('/cats', [
        'image_url' => 'https://www.google.com',
        'name' => 'test cat',
        'age' => 24,
        'breed' => 'example breed',
        'gender' => 'm',
        'description' => '<b>Test</b>',
    ])
        ->assertRedirect('/login');
});

it('auth user can create cat', function (): void {
    // Given
    $user = User::factory()->create();

    // When & Then
    actingAs($user)
        ->post('/cats', [
            'image_url' => 'https://www.google.com',
            'name' => 'test cat',
            'age' => 24,
            'breed' => 'example breed',
            'gender' => 'm',
            'description' => '<b>Test</b>',
        ])
        ->assertSessionHasNoErrors()
        ->assertSessionHas('success', __('Cat :cat has been created', ['cat' => 'Test Cat']));

    assertDatabaseCount('cats', 1);

    $created = Cat::first();

    assertModelExists($created);
    expect($created->id)->toBe(1);
    expect($created->image_url)->toBe('https://www.google.com');
    expect($created->name)->toBe('Test Cat');
    expect($created->age)->toBe(24);
    expect($created->gender)->toBe(CatGender::Male);
    expect($created->breed)->toBe('example breed');
    expect($created->description)->toBeHtml('<b>Test</b>');

});

it('guest user cannot display cat edit page', function (): void {
    // Given
    $cat = Cat::factory()->create();

    // When & Then
    get("/cats/{$cat->id}/edit")
        ->assertRedirect('/login');
});

it('auth user with permissions can display cat edit page', function (): void {
    // Given
    $user = User::factory()->create();
    $cat = Cat::factory()->create([
        'description' => '<b>Test</b>',
        'adding_user_id' => $user->id,
    ]);

    // When & Then
    actingAs($user)
        ->get("/cats/{$cat->id}/edit")
        ->assertOk()
        ->assertViewIs('user.cats.edit')
        ->assertSee($cat->image_url, false)
        ->assertSee($cat->name)
        ->assertSee($cat->age)
        ->assertSee($cat->gender->label())
        ->assertSee($cat->breed)
        ->assertSee(strip_tags($cat->description), false);
});

it('auth user without permissions cannot display cat edit page', function (): void {
    // Given
    $user = User::factory()->create();
    $cat = Cat::factory()->create();

    // When & Then
    actingAs($user)
        ->get("/cats/{$cat->id}/edit")
        ->assertForbidden();
});

it('guest user cannot update cat', function (): void {
    // Given
    $cat = Cat::factory()->create();

    // When & Then
    put("/cats/{$cat->id}", [
        'image_url' => 'https://www.google.com',
        'name' => 'test cat',
        'age' => 24,
        'breed' => 'example breed',
        'gender' => 'm',
        'description' => '<b>Test</b>',
    ])->assertRedirect('/login');

    assertDatabaseCount('cats', 1);
});

it('auth user without permissions cannot update cat', function (): void {
    // Given
    $user = User::factory()->create();
    $cat = Cat::factory()->create();

    // When & Then
    actingAs($user)
        ->put("/cats/{$cat->id}", [
            'image_url' => 'https://www.google.com',
            'name' => 'test cat',
            'age' => 24,
            'breed' => 'example breed',
            'gender' => 'm',
            'description' => '<b>Test</b>',
        ])->assertForbidden('/login');
});

it('auth user with permissions can update cat', function (): void {
    // Given
    $user = User::factory()->create();
    $cat = Cat::factory()->create([
        'adding_user_id' => $user->id,
    ]);

    // When & Then
    actingAs($user)
        ->put("/cats/{$cat->id}", [
            'image_url' => 'https://www.google.com',
            'name' => 'test cat',
            'age' => 24,
            'breed' => 'example breed',
            'gender' => 'm',
            'description' => '<b>Test</b>',
        ])->assertSessionHasNoErrors()
        ->assertSessionHas('success', __('Cat :cat has been updated', ['cat' => 'Test Cat']));

    assertDatabaseCount('cats', 1);

    $updated = Cat::first();

    assertModelExists($updated);
    expect($updated->id)->toBe($cat->id);
    expect($updated->image_url)->toBe('https://www.google.com');
    expect($updated->name)->toBe('Test Cat');
    expect($updated->age)->toBe(24);
    expect($updated->gender)->toBe(CatGender::Male);
    expect($updated->breed)->toBe('example breed');
    expect($updated->description)->toBeHtml('<b>Test</b>');

});

it('guest user cannot delete cat', function (): void {
    // Given
    $cat = Cat::factory()->create();

    // When & Then
    delete("/cats/{$cat->id}")
        ->assertRedirect('/login');
});


it('auth user with permissions can delete cat', function (): void {
    // Given
    $user = User::factory()->create();
    $cat = Cat::factory()->create([
        'adding_user_id' => $user->id,
    ]);

    // When & Then
    actingAs($user)
        ->delete("/cats/{$cat->id}")
        ->assertSessionHas('info', __('Cat :cat has been deleted', ['cat' => $cat->name]));

    assertModelMissing($cat);
});
