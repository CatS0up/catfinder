<?php

declare(strict_types=1);

use App\Actions\User\ChooseCatForAdoptionAction;
use App\Enums\CatStatus;
use App\Exceptions\AdoptionException;
use App\Models\Cat;
use App\Models\User;

beforeEach(function (): void {
    $this->actionUnderTest = app()->make(ChooseCatForAdoptionAction::class);
});

it('should throw AdoptionException exception when user try to adopt cat without "available" status', function (): void {
    // Given
    $adopter = User::factory()->create();
    $invalidStatuses = [
        CatStatus::Adopted,
        CatStatus::ForApproval,
    ];

    // When
    foreach ($invalidStatuses as $invalidStatus) {
        $cat = Cat::factory()->create([
            'status' => $invalidStatus,
        ]);

        $this->actionUnderTest->handle($cat->id, $adopter->id);
    }


})
    ->throws(AdoptionException::class, 'You can only adopt cats with the status of "available"');

it('should set cat status as "for_approval" and assign user as adopter when user choose given cat for adoption', function (): void {
    // Given
    $adopter = User::factory()->create();
    $subject = Cat::factory()->create([
        'status' => CatStatus::Available,
    ]);

    // When
    $cat = $this->actionUnderTest->handle($subject->id, $adopter->id);

    // Then
    expect($cat->status)->toBe(CatStatus::ForApproval);
    expect($cat->adopter->id)->toBe($adopter->id);
});
