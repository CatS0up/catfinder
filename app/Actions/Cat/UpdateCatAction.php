<?php

declare(strict_types=1);

namespace App\Actions\Cat;

use App\DataObjects\CatData;
use App\Models\Cat;
use Illuminate\Support\Arr;

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

        $cat->update(Arr::except($data->toArray(), 'adding_user_id'));

        return $cat;
    }
}
