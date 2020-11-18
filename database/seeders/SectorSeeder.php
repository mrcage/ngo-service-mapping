<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        foreach ([
            'Agriculture',
            'Camp Coordination and Camp Management',
            'Climate Change and Environment',
            'Coordination',
            'Disaster Management',
            'Education',
            'Food and Nutrition',
            'Gender',
            'Health',
            'HIV/Aids',
            'Mine Action',
            'Peacekeeping and Peacebuilding',
            'Protection and Human Rights',
            'Recovery and Reconstruction',
            'Safety and Security',
            'Shelter and Non-Food Items',
            'Water, Sanitation & Hygiene',
        ] as $sector) {
            Sector::create(['name' => $sector]);
        }
    }
}
