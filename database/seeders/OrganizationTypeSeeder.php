<?php

namespace Database\Seeders;

use App\Models\OrganizationType;
use Illuminate\Database\Seeder;
use Schema;

class OrganizationTypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        OrganizationType::truncate();
        foreach ([
            'Academic and Research Institution',
            'Government',
            'Intergovernmental Organization',
            'International non-governmental Organization',
            'Media',
            'Non-governmental Organization',
            'Red Cross/Red Crescent Movement',
            'Volunteer Group',
            'Other',
        ] as $name) {
            OrganizationType::create(['name' => $name]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
