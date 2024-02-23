<?php

namespace Database\Seeders;

use App\Models\Bridge;
use App\Models\BridgePoint;
use App\Models\Type;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class BridgePointSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $bridgeInternationHidalgo = Bridge::whereStr('bridge-internacional-hidalgo')->first();
        $typePedestrian = Type::whereStr('type-pedestrian')->first();
        $typeVehicle = Type::whereStr('type-vehicle')->first();

        $points = [
            //points for Puente Internacional Hidalgo PEATONAL (pedestrian)
            ['name' => 'GARITAS', 'coordinates' => '26.0973626370259, -98.27023611068306', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],
            ['name' => 'Fin de la zona techada', 'coordinates' => '26.096917, -98.270579', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],
            ['name' => 'División por paso vehicular', 'coordinates' => '26.096678193426882, -98.27075599999857', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],
            ['name' => 'Continuación de la fila', 'coordinates' => '26.09641021789655, -98.27090620370403', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],
            ['name' => 'Esquina Zona Techada', 'coordinates' => '26.09613200444909, -98.27099538715402', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],
            ['name' => 'Bebederos', 'coordinates' => '26.09605291505715, -98.27141018720891', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],
            ['name' => 'Linea Divisoria MEX EUA', 'coordinates' => '26.095373982869692, -98.27179253902455', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],
            ['name' => 'Inicio del Puente', 'coordinates' => '26.094664309833174, -98.27216478585272', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],
            ['name' => 'Caseta de Cobro', 'coordinates' => '26.093921103513505, -98.27181194255726', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],
            ['name' => 'Inicio de Zona Enrejada', 'coordinates' => '26.093436055394683, -98.27146524796835', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],
            ['name' => 'Acceso Peatonal a Puente Int', 'coordinates' => '26.092735631394024, -98.27200681620202', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typePedestrian->id],

            //points for Puente Internacional Hidalgo PEATONAL (vehicle)
            ['name' => 'GARITAS', 'coordinates' => '26.0973626370259, -98.27023611068306', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'División de carriles', 'coordinates' => '26.096049988569277, -98.2708643872559', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Linea Divisoria MEX EUA', 'coordinates' => '26.095373982869692, -98.27179253902455', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Caseta de Cobro', 'coordinates' => '26.093921103513505, -98.27181194255726', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Inicio de Oficinas CITEV', 'coordinates' => '26.091466820961795, -98.26871261246566', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Fin de Oficinas CITEV', 'coordinates' => '26.08911990075289, -98.26689511483639', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Hospital del Rio', 'coordinates' => '26.087242440786653, -98.26674559638404', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Clinica San Francisco', 'coordinates' => '26.08666204046293, -98.26635924970235', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Entronque / Plaza Comercial', 'coordinates' => '26.085116939663948, -98.26542560318053', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Entrada a Carril Puente Internacional', 'coordinates' => '26.084359684094505, -98.26548683568521', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Canchas de Futbol', 'coordinates' => '26.08354353485851, -98.26579506829232', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Casa de cambio', 'coordinates' => '26.08168366255536, -98.26648700561515', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'Canchas de Softbol', 'coordinates' => '26.080023713435356, -98.26674777486923', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],
            ['name' => 'El más allá', 'coordinates' => '26.07845805803962, -98.26573445004071', 'bridge_id' => $bridgeInternationHidalgo->id, 'type_id' => $typeVehicle->id],

        ];

        foreach ($points as $point) {
            BridgePoint::firstOrCreate([
                'name' => $point['name'],
                'coordinates' => $point['coordinates'],
                'bridge_id' => $point['bridge_id'],
                'type_id' => $point['type_id'],
            ]);
        }
    }


    // Parse.Cloud.define("listBridge", async function(req,res){
    //     // Crear una consulta para la clase Bridge
    //     var bridgeQuery = new Parse.Query("Bridge");

    //     // Incluir los ReferencePoint asociados a cada Bridge
    //     bridgeQuery.include("referencePoints");

    //     // Ejecutar la consulta
    //     bridgeQuery.find().then(function(bridges) {
    //     return JSON.stringify(obj);
    //     }).catch(function(error) {
    //     console.error("Error al realizar la consulta: " + error.message);
    //     });
    // });
}
