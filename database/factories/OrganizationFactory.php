<?php

namespace Database\Factories;

use App\Models\Organization;
use App\Models\OrganizationType;
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
        $types = OrganizationType::all();

        return $this->afterMaking(function (Organization $organization) use ($types) {
            if ($types->isNotEmpty()) {
                $type = $types->random();
                $organization->type()->associate($type);
            }
        });
    }
}
