<?php

declare(strict_types=1);

namespace App\DataObjects;

use Spatie\LaravelData\Data;
use App\Enums\CatGender;
use App\Enums\CatStatus;
use Spatie\LaravelData\Attributes\WithCast;
use Spatie\LaravelData\Casts\EnumCast;

final class CatData extends Data
{
    #[WithCast(EnumCast::class)]
    public readonly CatStatus $status;

    public function __construct(
        public readonly ?int $id = null,
        public readonly string $image_url,
        public readonly string $name,
        public readonly int $age,
        public readonly string $breed,
        #[WithCast(EnumCast::class)]
        public readonly CatGender $gender,
        public readonly string $description,
        public readonly ?int $adding_user_id = null,
    ) {
        $this->status = CatStatus::Available;
    }
}
