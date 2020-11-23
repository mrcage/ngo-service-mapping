<?php

namespace Database\Seeders;

use App\Models\TargetGroup;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Schema;

class TargetGroupSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Schema::disableForeignKeyConstraints();
        TargetGroup::truncate();
        foreach ([
            'Women',
            'Men',
            'Mothers',
            'Families',
            'Children',
            'Elderly',
            'Babies',
            'Disabled',
            'LGBTQI+',
            'Asylum Seekers',
            'Refugees',
            'Migrants',
        ] as $name) {
            TargetGroup::create(['name' => $name]);
        }
        Schema::enableForeignKeyConstraints();
    }
}
