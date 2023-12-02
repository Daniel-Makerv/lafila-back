<?php

namespace Database\Seeders;

use App\Models\Integration;
use App\Models\IntegrationField;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntegrationFieldSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        IntegrationField::firstOrCreate([
            'name' => 'geolocation',
            'integration_id' => Integration::whereStr('google-platform')->first()->id,
            'str' => 'maps-geolocation-directions',
        ]);
    }
}
