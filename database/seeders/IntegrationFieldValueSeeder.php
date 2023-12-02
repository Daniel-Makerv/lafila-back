<?php

namespace Database\Seeders;

use App\Models\IntegrationField;
use App\Models\IntegrationFieldValue;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntegrationFieldValueSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        IntegrationFieldValue::firstOrCreate([
            'value' => 'maps/api/directions/json',
            'integration_field_id' => IntegrationField::whereStr('maps-geolocation-directions')->first()->id,
        ]);
    }
}
