<?php

declare(strict_types=1);

use App\Actions\Cat\CreateCatAction;
use App\DataObjects\CatData;
use App\Models\User;

use function Pest\Laravel\assertModelExists;

beforeEach(function (): void {
    $this->actionUnderTest = app()->make(CreateCatAction::class);
});

it('should create new cat', function (): void {
    // Given
    $addingUser = User::factory()->create();
    $catData = CatData::from([
        'image_url' => 'www.google.pl',
        'name' => 'Garfield',
        'age' => 2,
        'breed' => 'fat cat',
        'gender' => 'm',
        'description' => '<b>Lasangeeee</b>',
    ]);

    // When
    $newCat = $this->actionUnderTest->handle($catData, $addingUser->id);

    // Then
    assertModelExists($newCat);
    expect($newCat->image_url)->toBe($catData->image_url);
    expect($newCat->age)->toBe($catData->age);
    expect($newCat->breed)->toBe($catData->breed);
    expect($newCat->gender)->toBe($catData->gender);
    expect($newCat->description)->toBe($catData->description);
});
