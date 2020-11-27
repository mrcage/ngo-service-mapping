<?php

namespace Database\Seeders;

use App\Models\Sector;
use Illuminate\Database\Seeder;
use Schema;

class SectorSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        Sector::truncate();
        foreach ([
            'Advocacy',
            'Agriculture',
            'Camp Coordination and Camp Management',
            'Climate Change and Environment',
            'Coordination',
            'Disaster Management',
            'Education',
            'Emergency Telecommunications',
            'Food and Nutrition',
            'Gender',
            'Health',
            'HIV/Aids',
            'Logistics',
            'Mine Action',
            'Peacekeeping and Peacebuilding',
            'Protection and Human Rights',
            'Recovery and Reconstruction',
            'Safety and Security',
            'Shelter and Non-Food Items',
            'Water, Sanitation & Hygiene',
        ] as $name) {
            Sector::create(['name' => $name]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
