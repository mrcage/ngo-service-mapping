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
            'WASH',
            'Food',
            'Shelter',
            'Protection',
            'Medical',
            'Legal Aid',
            'Education',
            'Sport',
            'Logistics',
            'Advocacy',
            'Children',
            'LGBTQI+',
            'Women',
        ] as $sector) {
            Sector::create(['name' => $sector]);
        }
    }
}
