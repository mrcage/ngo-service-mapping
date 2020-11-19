<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\OrganizationType;
use App\Models\Sector;
use Illuminate\Database\Eloquent\Factories\Factory;

class OrganizationFactory extends Factory
{
    /**
     * The name of the factory's corresponding model.
     *
     * @var string
     */
    protected $model = Organization::class;

    /**
     * Define the model's default state.
     *
     * @return array
     */
    public function definition()
    {
        $description = $this->faker->optional(0.7)->paragraphs;
        return [
            'name' => $this->faker->unique()->company,
            'description' => $description !== null ? implode("\n", $description) : null,
            'email' => $this->faker->optional(0.9)->companyEmail,
            'website' => $this->faker->optional(0.7)->url,
        ];
    }

    /**
     * Configure the model factory.
     *
     * @return $this
     */
    public function configure()
    {
        $sectors = Sector::all();
        $types = OrganizationType::all();

        return $this->afterMaking(function (Organization $organization) use ($types) {
            if ($types->isNotEmpty()) {
                $type = $types->random();
                $organization->type()->associate($type);
            }
        })->afterCreating(function (Organization $organization) use ($sectors) {
            if ($sectors->isNotEmpty()) {
                $num = mt_rand(0, $sectors->count());
                $chosen_sectors = $sectors->random($num);
                $organization->sectors()->sync($chosen_sectors);
            }
        });
    }
}
