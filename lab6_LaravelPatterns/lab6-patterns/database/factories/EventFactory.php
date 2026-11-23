<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Enums\EventTypeEnum;
use App\Models\Organizer;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\Event>
 */
class EventFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'name' => $this->faker->sentence(3),
            'description' => $this->faker->paragraph(3),
            'type' => EventTypeEnum::cases()[array_rand(EventTypeEnum::cases())]->value,
            'date' => $this->faker->date(),
            'organizer_id' => Organizer::inRandomOrder()->value('id'),
        ];
    }
}
