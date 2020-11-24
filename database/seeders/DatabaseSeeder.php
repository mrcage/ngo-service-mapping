<?php

namespace Database\Seeders;

use App;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        if (App::environment() === 'production')
        {
            $this->call([
                SectorSeeder::class,
                OrganizationTypeSeeder::class,
            ]);
        }
        else
        {
            $this->call([
                UserSeeder::class,
                SectorSeeder::class,
                OrganizationTypeSeeder::class,
                OrganizationSeeder::class,
                LocationSeeder::class,
                TargetGroupSeeder::class,
                ServiceSeeder::class,
            ]);
        }
    }
}
