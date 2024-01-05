<?php

declare(strict_types=1);

namespace App\Actions\User;

use App\Enums\CatStatus;
use App\Exceptions\AdoptionException;
use App\Models\Cat;

final class ChooseCatForAdoptionAction
{
    public function __construct(private Cat $cat)
    {

    }

    public function handle(int $id, int $adopterId): Cat
    {
        /** @var Cat */
        $cat = $this->cat->query()->findOrFail($id);

        $this->ensureCatHasForApprovalStatus($cat);

        $cat->markAsForApproval($adopterId);

        return $cat;
    }

    private function ensureCatHasForApprovalStatus(Cat $cat): void
    {
        if (CatStatus::Available !== $cat->status) {
            throw AdoptionException::catHasInvalidStatus();
        }
    }
}
