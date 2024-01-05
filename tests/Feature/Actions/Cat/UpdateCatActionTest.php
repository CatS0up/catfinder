<?php

declare(strict_types=1);

use App\Actions\Cat\UpdateCatAction;
use App\DataObjects\CatData;
use App\Models\Cat;

use function Pest\Laravel\assertModelExists;

beforeEach(function (): void {
    $this->actionUnderTest = app()->make(UpdateCatAction::class);
});

it('should update existing cat', function (): void {
    // Given
    $cat = Cat::factory()->create([
        'image_url' => 'www.google.pl',
        'name' => 'old name',
        'age' => 2,
        'breed' => 'race 2.0',
        'gender' => 'm',
        'status' => 'adopted',
        'description' => '<b>Description</b>',
    ]);

    $catData =  CatData::from([
        'image_url' => 'www.yahoo.pl',
        'name' => 'new name',
        'age' => 17,
        'breed' => 'breed 9.0',
        'gender' => 'f',
        'status' => 'available',
        'description' => '<b>new description</b>',
    ]);

    // When
    $updatedCat = $this->actionUnderTest->handle(
        $cat->id,
        $catData
    );

    // Then
    expect($updatedCat->id)->toBe($cat->id);
    assertModelExists($updatedCat);
    expect($updatedCat->image_url)->toBe($catData->image_url);
    expect($updatedCat->age)->toBe($catData->age);
    expect($updatedCat->breed)->toBe($catData->breed);
    expect($updatedCat->gender)->toBe($catData->gender);
    expect($updatedCat->description)->toBe($catData->description);
});
