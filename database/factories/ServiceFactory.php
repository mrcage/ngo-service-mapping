<?php

namespace Database\Factories;

use App\Models\Location;
use App\Models\Organization;
use App\Models\Service;
use App\Models\TargetGroup;
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
        $targetGroups = TargetGroup::all();

        return $this->afterMaking(function (Service $service) use ($locations, $organizations) {
            if ($locations->isNotEmpty()) {
                $service->location()->associate($locations->random());
            }
            if ($organizations->isNotEmpty()) {
                $service->organization()->associate($organizations->random());
            }
        })->afterCreating(function (Service $service) use ($targetGroups) {
            if ($targetGroups->isNotEmpty()) {
                $num = mt_rand(0, $targetGroups->count());
                $selection = $targetGroups->random($num);
                $service->targetGroups()->sync($selection);
            }
        });
    }
}
