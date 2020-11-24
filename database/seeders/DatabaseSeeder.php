<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Database\Seeders\PropertiesSeeder;
use Database\Seeders\AnalyticTypesSeeder;
use Database\Seeders\PropertyAnalyticsSeeder;

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
            PropertiesSeeder::class,
            AnalyticTypesSeeder::class,
            PropertyAnalyticsSeeder::class,
        ]);
    }
}
