<?php

declare(strict_types=1);

namespace Database\Factories;

use App\Enums\CatGender;
use App\Enums\CatStatus;
use App\Models\User;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Cat>
 */
class CatFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'image_url' => fake()->url(),
            'name' => fake()->unique()->word(),
            'age' => fake()->randomDigitNot(0),
            'breed' => fake()->word(),
            'gender' => fake()->randomElement(CatGender::class)->value,
            'status' => fake()->randomElement(CatStatus::class)->value,
            'description' => fake()->randomHtml(),

            'adding_user_id' => User::factory()->create(),
        ];
    }

    public function status(CatStatus $status): static
    {
        return $this->state(fn (array $attributes) => [
            'status' => $status,
        ]);
    }
}
