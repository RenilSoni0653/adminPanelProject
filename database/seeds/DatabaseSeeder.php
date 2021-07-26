<?php

use Illuminate\Database\Seeder;
use App\Table;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->call([
            TableSeeder::class,
            AdditionalSeedForTable::class,
            CountrySeeder::class,
            StateSeeder::class,
            CitySeeder::class,
            demoSeeder_1::class,
            demoSeeder_2::class,
            demoSeeder_3::class,
        ]);
    }
}