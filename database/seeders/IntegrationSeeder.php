<?php

namespace Database\Seeders;

use App\Models\Integration;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class IntegrationSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //

        Integration::firstOrCreate([
            'name' => 'Google',
            'str' => 'google-platform',
            'type_id' => Type::whereStr('integration_platform')->first()->id,
        ]);
    }
}
