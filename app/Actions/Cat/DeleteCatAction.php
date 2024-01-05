<?php

declare(strict_types=1);

namespace App\Actions\Cat;

use App\Models\Cat;

final class DeleteCatAction
{
    public function __construct(
        private Cat $cat,
    ) {
    }

    public function handle(int $id): bool
    {
        /** @var Cat */
        $cat = $this->cat->query()->findOrFail($id);

        return (bool) $cat->delete();
    }
}
