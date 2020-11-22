<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Organization;
use App\Models\Service;
use Illuminate\Database\Eloquent\Factories\Factory;

class ServiceFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Service::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $description = $this->faker->optional(0.7)->paragraphs;
        return [
            'name' => $this->faker->catchPhrase,
            'description' => $description !== null ? implode("\n", $description) : null,
        ];
    }

        /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        $locations = Location::all();
        $organizations = Organization::all();

        return $this->afterMaking(function (Service $service) use ($locations, $organizations) {
            if ($locations->isNotEmpty()) {
                $service->location()->associate($locations->random());
            }
            if ($organizations->isNotEmpty()) {
                $service->organization()->associate($organizations->random());
            }
        });
    }
}
