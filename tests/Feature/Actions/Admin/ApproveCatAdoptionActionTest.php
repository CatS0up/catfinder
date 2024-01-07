<?php

declare(strict_types=1);

use App\Actions\Admin\CancelCatAdoptionAction;
use App\Actions\Admin\ApproveCatAdoptionAction;
use App\Enums\CatStatus;
use App\Exceptions\Admin\AdoptionApproveException;
use App\Models\Cat;
use App\Models\User;

beforeEach(function (): void {
    $this->actionUnderTest = app()->make(ApproveCatAdoptionAction::class);
});

it('should throw AdoptionApproveException when user tries to approve adoption with invalid cat status', function (CatStatus $invalidStatus): void {
    // Given
    $cat = Cat::factory()->status($invalidStatus)->create();

    // When
    $this->actionUnderTest->handle($cat->id);
})->throws(AdoptionApproveException::class, 'You can only aprove cats with the status of "for_approval"')
    ->with([
        'adopted status' => CatStatus::Adopted,
        'available status' => CatStatus::Available,
    ]);

it('should make cat adopted when user approve adoption', function (): void {
    // Given
    $adopter = User::factory()->create();
    $cat = Cat::factory()
        ->for($adopter, 'adopter')
        ->status(CatStatus::ForApproval)
        ->create();

    // When
    $updated = $this->actionUnderTest->handle($cat->id);

    // Then
    expect($cat->id)->toBe($updated->id);
    expect($updated->status)->toBe(CatStatus::Adopted);
    expect($updated->adopter->id)->toBe($adopter->id);
});
