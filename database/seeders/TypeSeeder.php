<?php

namespace Database\Seeders;

use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class TypeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Type::firstOrCreate([
            'name' => 'get',
            'str' =>  'get',
            'description' => 'type request',
        ]);

        Type::firstOrCreate([
            'name' => 'integration_platform',
            'str' =>  'integration_platform',
            'description' => 'plataform integration',
        ]);

        Type::firstOrCreate([
            'name' => 'bridge',
            'str' =>  'type-bridge',
            'description' => 'type bridge',
        ]);

         Type::firstOrCreate([
            'name' => 'walking',
            'str' =>  'type-pedestrian',
            'description' => 'type pedestrian',
        ]);

        Type::firstOrCreate([
            'name' => 'driving',
            'str' =>  'type-vehicle',
            'description' => 'type vehicle',
        ]);

    }
}
