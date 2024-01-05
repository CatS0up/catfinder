<?php

declare(strict_types=1);

namespace App\Actions\Cat;

use App\DataObjects\CatData;
use App\Models\Cat;

final class CreateCatAction
{
    public function __construct(
        private Cat $cat,
    ) {
    }

    public function handle(CatData $catData, int $addingUserId): Cat
    {
        /** @var Cat */
        $cat = $this->cat->query()->create([
            ...$catData->toArray(),
            'adding_user_id' => $addingUserId,
        ]);

        return $cat;
    }
}
