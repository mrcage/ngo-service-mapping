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
            'International Organization',
            'Media',
            'Non-governmental Organization',
            'Other',
            'Red Cross/Red Crescent Movement',
        ] as $name) {
            OrganizationType::create(['name' => $name]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
