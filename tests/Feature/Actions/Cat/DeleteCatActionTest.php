<?php

declare(strict_types=1);

use App\Actions\Cat\DeleteCatAction;
use App\Models\Cat;

use function Pest\Laravel\assertModelMissing;

beforeEach(function (): void {
    $this->actionUnderTest = app()->make(DeleteCatAction::class);
});

it('it should delete existing cat', function (): void {
    // Given
    $cat = Cat::factory()->create();

    // When
    $isDeleted = $this->actionUnderTest->handle($cat->id);

    // Then
    expect($isDeleted)->toBeTrue();
    assertModelMissing($cat);
});
