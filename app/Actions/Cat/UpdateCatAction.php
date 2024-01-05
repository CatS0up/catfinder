<?php

declare(strict_types=1);

namespace App\Actions\Cat;

use App\DataObjects\CatData;
use App\Models\Cat;

final class UpdateCatAction
{
    public function __construct(
        private Cat $cat,
    ) {
    }

    public function handle(int $id, CatData $data): Cat
    {
        /** @var Cat */
        $cat = $this->cat->query()
            ->findOrFail($id);

        $cat->update($data->toArray());

        return $cat;
    }
}
