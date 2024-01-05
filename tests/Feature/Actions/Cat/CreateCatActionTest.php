<?php

use App\Actions\Cat\CreateCatAction;
use App\DataObjects\CatData;
use App\Models\User;

use function Pest\Laravel\assertDatabaseHas;
use function Pest\Laravel\assertModelExists;

beforeEach(function () {
    $this->actionUnderTest = app()->make(CreateCatAction::class);
});

it ('should create new cat', function () {
    // Given
    $addingUser = User::factory()->create();
    $catData = CatData::from([
        'image_url' => 'www.google.pl',
        'name' => 'Garfield',
        'age' => 2,
        'race' => 'fat cat',
        'gender' => 'm',
        'description' => '<b>Lasangeeee</b>',
    ]);

    // When
    $newCat = $this->actionUnderTest->handle($catData, $addingUser->id);

    // Then
    assertModelExists($newCat);
});
