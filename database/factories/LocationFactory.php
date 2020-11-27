<?php

namespace Database\Factories;

use App\Models\Location;
use Illuminate\Database\Eloquent\Factories\Factory;

class LocationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Location::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $description = $this->faker->optional(0.7)->paragraphs;
        $hasCoordinates = $this->faker->boolean(70);
        return [
            'name' => $this->faker->address,
            'description' => $description !== null ? implode("\n", $description) : null,
            'latitude' => $hasCoordinates ? $this->faker->latitude(60, -40) : null,
            'longitude' => $hasCoordinates? $this->faker->longitude(120, -120) : null,
        ];
    }
}
