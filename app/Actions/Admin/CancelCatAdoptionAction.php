<?php

declare(strict_types=1);

namespace App\Actions\Admin;

use App\Enums\CatStatus;
use App\Exceptions\Admin\AdoptionApproveException;
use App\Models\Cat;

final class CancelCatAdoptionAction
{
    public function __construct(
        private Cat $cat,
    ) {
    }

    public function handle(int $id): Cat
    {
        /** @var Cat */
        $cat = $this->cat->findOrFail($id);

        $this->ensureCatHasForApprovalStatus($cat);

        $cat->markAsAvailable();

        return $cat;
    }

    public function ensureCatHasForApprovalStatus(Cat $cat): void
    {
        if(CatStatus::ForApproval !== $cat->status) {
            throw AdoptionApproveException::catHasInvalidStatus();
        }
    }
}
