<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;
use App\Models\rooms;

/**
 * @extends \Illuminate\Database\Eloquent\Factories\Factory<\App\Models\items>
 */
class ItemsFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array<string, mixed>
     */
    public function definition(): array
    {
        return [
            'item_name' => fake()->word,
            'item_quantity' => fake()->numberBetween(1, 100),
            'category' => $this->faker->randomElement(['Classroom Items', 'Office Items', 'Library Items',
             'Science Lab Items', 'Art Room Items', 'Music Room Items', 'Gymnasium and Sports Items',
             'Cafeteria Items', 'Maintenance Items', 'Playground Items', 'Miscellaneous Items']),
            'unit_of_measure' => $this->faker->randomElement(['Sets', 'Pieces', 'Packs', 'Kits']),
            'room_number' => $this->faker->randomDigitNotNull,
            'school_level' => $this->faker->randomElement(['Junior High School', 'Senior High School']),
            'acceptedby' => $this->faker->name,
        ];
    }
}
