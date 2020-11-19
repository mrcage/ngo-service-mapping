<?php

namespace Database\Seeders;

use App;
use App\Models\User;
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
            ]);
        }
        else
        {
            $this->call([
                UserSeeder::class,
                SectorSeeder::class,
                OrganizationSeeder::class,
            ]);
        }
    }
}
