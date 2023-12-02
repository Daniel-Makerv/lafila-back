<?php

namespace App\Helpers\BridgeHelper;

use App\Models\Bridge as ModelsBridge;
use App\Models\Type;
use Exception;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Log;

class Bridge
{
    public static function getPointsOfBridge($brideStr, $typePointStr)
    {
        $bridge = ModelsBridge::whereStr($brideStr)->first();
        $typePointStr = Type::whereStr($typePointStr)->first();

        if ($bridge == null || $typePointStr == null)
            return throw new Exception("bridge or mode found", 404);

        return $bridge->bridgePoints()->join('bridges', 'bridge_points.bridge_id', 'bridges.id')->join('types', 'bridges.type_id', 'types.id')
            ->where('bridge_points.type_id', $typePointStr->id)
            ->select('bridge_points.*', 'types.name as typeBridged')->get();
    }

    public static function getPointForBridge($brideStr, $bridePointName, $typePointStr)
    {
        $bridge = ModelsBridge::whereStr($brideStr)->first();
        $typePointStr = Type::whereStr($typePointStr)->first();

        if ($bridge == null || $typePointStr == null)
            return throw new Exception("bridge or mode found", 404);

        return $bridge->bridgePoints()->join('bridges', 'bridge_points.bridge_id', 'bridges.id')->join('types', 'bridges.type_id', 'types.id')
            ->where('bridge_points.type_id', $typePointStr->id)
            ->where('bridge_points.name', $bridePointName)
            ->select('bridge_points.*', 'types.name as typeBridged')->firstOr(function () use ($bridge) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException('No existe este punto en el puente ' . $bridge->name);
            });
    }

    public static function getReferenceDestinationGaritas($brideStr, $typePointStr)
    {
        $bridge = ModelsBridge::whereStr($brideStr)->first();
        $typePointStr = Type::whereStr($typePointStr)->first();

        if ($bridge == null || $typePointStr == null)
            return throw new Exception("bridge or mode found", 404);

        return $bridge->bridgePoints()->join('bridges', 'bridge_points.bridge_id', 'bridges.id')->join('types', 'bridges.type_id', 'types.id')
            ->where('bridge_points.type_id', $typePointStr->id)
            ->where('bridge_points.name', 'GARITAS')
            ->select('bridge_points.*', 'types.name as typeBridged')->select('bridge_points.*', 'types.name as typeBridged')->firstOr(function () use ($bridge) {
                throw new \Illuminate\Database\Eloquent\ModelNotFoundException('Resultados encontrados ' . $bridge->name);
            });
    }
}
