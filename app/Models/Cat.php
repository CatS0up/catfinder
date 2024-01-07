<?php

declare(strict_types=1);

namespace App\Models;

use App\DataObjects\CatData;
use App\Enums\CatGender;
use App\Enums\CatStatus;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
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
        'breed',
        'gender',
        'status',
        'description',
        'adopter_id',
        'adding_user_id',
    ];

    protected $casts = [
        'gender' => CatGender::class,
        'status' => CatStatus::class,
    ];

    /** @var array<string, mixed> */
    protected $attributes = [
        'status' => CatStatus::Available,
    ];

    /** @var string */
    protected $dataClass = CatData::class;

    /** @param \Illuminate\Database\Eloquent\Builder<Cat> $query */
    public function scopeAvailable(Builder $query): void
    {
        $query->whereStatus(CatStatus::Available);
    }

    /** @param \Illuminate\Database\Eloquent\Builder<Cat> $query */
    public function scopeAdopted(Builder $query): void
    {
        $query->whereStatus(CatStatus::Adopted);
    }

    /**
     * @return Attribute<string, string>
     */
    public function name(): Attribute
    {
        return new Attribute(set: fn (string $value) => str($value)->title());
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Cat>
     */
    public function adopter(): BelongsTo
    {
        return $this->belongsTo(User::class, 'adopter_id');
    }

    /**
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo<User, Cat>
     */
    public function addingUser(): BelongsTo
    {
        return $this->belongsTo(User::class, 'adding_user_id');
    }

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
