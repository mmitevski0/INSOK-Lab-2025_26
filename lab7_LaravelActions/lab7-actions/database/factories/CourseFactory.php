<?php

namespace Database\Factories;

use App\Enums\CourseLevelEnum;
use Illuminate\Database\Eloquent\Factories\Factory;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Course>
 */
class CourseFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'title' => $this->faker->sentence(3),
            'summary' => $this->faker->paragraph(),
            'level' => CourseLevelEnum::cases()[array_rand(CourseLevelEnum::cases())]->value,
            'start_date' => $this->faker->date(),
            'seats' => $this->faker->numberBetween(5, 30),
        ];
    }
}
