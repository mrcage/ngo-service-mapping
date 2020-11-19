<?php

namespace Database\Seeders;

use App\Models\OrganizationType;
use Illuminate\Database\Seeder;

class OrganizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([
            'Academic and Research Institution',
            'Government',
            'International Organization',
            'Media',
            'Non-governmental Organization',
            'Other',
            'Red Cross/Red Crescent Movement',
        ] as $sector) {
            OrganizationType::create(['name' => $sector]);
        }
    }
}
