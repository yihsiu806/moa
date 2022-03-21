<?php

namespace Database\Factories;

use Illuminate\Database\Eloquent\Factories\Factory;

class FilesFactory extends Factory
{
    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        return [
            'title' => $this->faker->name,
            'description' => $this->faker->text(),
            'from' => $this->faker->date(),
            'to' => $this->faker->date(),
            'download' => 0,
            'path' => $this->faker->text(10),
            'owner' => $this->faker->randomElement([3, 4, 5, 11, 12, 13, 14]),
            'division' => $this->faker->numberBetween(1, 8),
            'created_at' => $this->faker->date(),
            'updated_at' => $this->faker->date(),
        ];
    }
}
