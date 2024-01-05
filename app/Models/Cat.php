<?php

declare(strict_types=1);

namespace App\Models;

use App\DataObjects\CatData;
use App\Enums\CatGender;
use App\Enums\CatStatus;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\LaravelData\WithData;

class Cat extends Model
{
    use HasFactory;

    /**
     * @use WithData<CatData>
     */
    use WithData;

    protected $fillable = [
        'image_url',
        'name',
        'age',
        'race',
        'gender',
        'status',
        'description',
    ];

    protected $casts = [
        'gender' => CatGender::class,
        'status' => CatStatus::class,
    ];

    /** @var string */
    protected $dataClass = CatData::class;

    public function markAsForApproval(int $adopterId): void
    {
        $this->fill([
            'status' => CatStatus::ForApproval,
            'adopter_id' => $adopterId,
        ]);

        $this->save();
    }

    public function markAsAvailable(): void
    {
        $this->fill([
            'status' => CatStatus::Available,
            'adopter_id' => null,
        ]);

        $this->save();
    }

    public function markAsAdopted(): void
    {
        $this->fill([
            'status' => CatStatus::Adopted,
        ]);

        $this->save();
    }
}
