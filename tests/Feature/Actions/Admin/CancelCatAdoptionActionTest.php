<?php

declare(strict_types=1);

use App\Actions\Admin\CancelCatAdoptionAction;
use App\Enums\CatStatus;
use App\Exceptions\Admin\AdoptionApproveException;
use App\Models\Cat;
use App\Models\User;

beforeEach(function (): void {
    $this->actionUnderTest = app()->make(CancelCatAdoptionAction::class);
});

it('should throw AdoptionApproveException when user tries to cancel adoption with invalid cat status', function (CatStatus $invalidStatus): void {
    // Given
    $cat = Cat::factory()->status($invalidStatus)->create();

    // When
    $this->actionUnderTest->handle($cat->id);
})->throws(AdoptionApproveException::class, 'You can only aprove cats with the status of "for_approval"')
    ->with([
        'adopted status' => CatStatus::Adopted,
        'available status' => CatStatus::Available,
    ]);

it('should make cat available again when user cancels adoption', function (): void {
    // Given
    $cat = Cat::factory()
        ->for(User::factory(), 'adopter')
        ->status(CatStatus::ForApproval)
        ->create();

    // When
    $updated = $this->actionUnderTest->handle($cat->id);

    // Then
    expect($cat->id)->toBe($updated->id);
    expect($updated->status)->toBe(CatStatus::Available);
    expect($updated->adopter)->toBeNull();
});
