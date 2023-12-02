<?php

namespace Database\Seeders;

use App\Models\Bridge;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BridgeSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bridges = [
            ["name" => "Puente Internacional Hidalgo", "str" => "bridge-internacional-hidalgo"],
            ["name" => "Puente Internacional Pharr", "str" => "bridge-internacional-pharr"],
            ["name" => "Puente Internacional Anzalduas", "str" => "bridge-internacional-anzalduas"]

        ];

        foreach ($bridges as $bridge) {
            Bridge::firstOrCreate([
                'name' => $bridge["name"],
                'type_id' => Type::whereStr('type-bridge')->first()->id,
                'str' => $bridge["str"],
            ]);
        }
    }
}
