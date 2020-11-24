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
            'abbreviation' => $this->faker->boolean(50) ? strtoupper($this->faker->lexify('???')) : null,
            'description' => $description !== null ? implode("\n", $description) : null,
            'email' => $this->faker->optional(0.9)->companyEmail,
            'phone' => $this->faker->optional(0.3)->e164PhoneNumber,
            'website' => $this->faker->optional(0.7)->url,
            'facebook' => $this->faker->optional(0.8)->url,
            'instagram' => $this->faker->optional(0.5)->url,
            'twitter' => $this->faker->optional(0.3)->url,
            'youtube' => $this->faker->optional(0.1)->url,
            'linkedin' => $this->faker->optional(0.1)->url,
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
