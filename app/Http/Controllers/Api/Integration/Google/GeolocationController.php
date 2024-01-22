<?php

namespace App\Http\Controllers\Api\Integration\Google;

use App\Helpers\BridgeHelper\Bridge as BridgeHelper;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\Geolocation;
use App\Models\IntegrationField;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\Log;

class GeolocationController extends Controller
{

    public function getClient()
    {
        return new Client([
            'base_uri' => config("app.maps_google_api_url"),
        ]);
    }
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Geolocation\Store $request)
    {
        $client = $this->getClient();

        try {
            $pointsArray = [];
            $mode = match ($request->mode) {
                'pedestrian' => 'type-pedestrian',
                'vehicle' => 'type-vehicle',
                default => throw new Exception("Error not found mode", 404),
            };

            $point = BridgeHelper::getPointForBridge($request->bridge, $request->pointName, $mode);
            $destination = BridgeHelper::getReferenceDestinationGaritas($request->bridge,  $mode);
            $sendRequest = $client->get('/maps/api/directions/json', [
                'query' => [
                    'origin' => $point->coordinates,
                    'destination' => $destination->coordinates, //cambiar por punto 0 del pente
                    'mode' => $point->typeBridged,
                    'country' => 'MX',
                    'key' => config("app.api_key_google"),
                ],
            ]);

            $response = json_decode($sendRequest->getBody(), true);
            $data = $response['routes'][0]['legs'][0];
            $pointsArray[] = (object)[
                'origin_request' => $point->coordinates,
                'origin_point' => $point->name,
                'destination_send' => $destination->name,
                'destination_coordinates' => $destination->coordinates,
                'origin_google' => $data['start_address'],
                'destination_google' => $data['end_address'],
                'mode' => $request->mode,
                'time' => $data['duration']['text'],
            ];
        } catch (\Exception $err) {
            return response()->json([
                'success' => false,
                'error' => $err->getMessage(),
                'code' => $err->getCode() ?? null,
            ], 500);
        }

        return response()->json([
            'success' => true,
            'message' => 'Correcto',
            'data' => $pointsArray,
            'code' => 200,
        ], 200);
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
