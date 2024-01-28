<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;

use App\Models\BridgePoint;
use App\Models\IntegrationField;
use App\Models\IntegrationFieldValue;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        $this->call([
            UserSeeder::class,
            // TypeSeeder::class,
            // IntegrationSeeder::class,
            // IntegrationFieldSeeder::class,
            // IntegrationFieldValueSeeder::class,
            // BridgeSeeder::class,
            // BridgePointSeeder::class,
        ]);
    }
}
