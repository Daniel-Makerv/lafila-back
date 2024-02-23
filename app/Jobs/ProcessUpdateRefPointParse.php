<?php

namespace App\Jobs;

use Exception;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

class ProcessUpdateRefPointParse implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct()
    {
        //
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {
        $clientParse = new Client([
            'headers' => [
                "Accept" => "*/*",
                "Content-Type" => "application/json",
                "F-PLUGIN" => "9d4095c8f7ed5785cb14c0e3b033eeb8252416ed",
                "Accept-Encoding" => "gzip, deflate",
                "Connection" => "keep-alive",
                'X-Parse-Application-Id' => 'BrounieApp',
                'X-Parse-Master-Key' => 'C4suYZKkyRMYPGR7fEae',
            ],
            'base_uri' => 'https://lafila.brounieapps.com/parse/functions/',
            'timeout' => 1000
        ]);

        try {
            $response = $clientParse->request('post', 'getPointsWithTimeForGoogle', [
                "body" => null,
            ]);

            $data = json_decode($response->getBody()->getContents());

            $clientGoogle = new Client([
                'base_uri' => config("app.maps_google_api_url"),
            ]);

            foreach ($data->result as $reference) {

                $clientGoogle = new Client([
                    'base_uri' => config("app.maps_google_api_url"),
                ]);
                if ($reference->direction != 'S/N') {
                    $destinationCords = match ($reference->crossing->name) {
                        'Hidalgo/Pharr - Pharr' => '26.088440344995245, -98.2008646317392',
                        'Hidalgo/Pharr - Anzalduas International Bridge' => '26.14560088711019, -98.31189316029355',
                        'Hidalgo/Pharr - Hidalgo' => '1121 S Bridge St i, Hidalgo, TX 78557, EE. UU.',
                        default => '1121 S Bridge St i, Hidalgo, TX 78557, EE. UU.',
                    };

                    $sendRequest = $clientGoogle->get('/maps/api/directions/json', [
                        'query' => [
                            'origin' => $reference->direction,
                            'destination' => $destinationCords,
                            'mode' => 'driving',
                            'country' => 'MX',
                            'departure_time' => 'now',
                            'key' => config("app.api_key_google"),
                        ],
                    ]);


                    $response = json_decode($sendRequest->getBody(), true);
                    $dataGoogle = $response['routes'][0]['legs'][0]['duration_in_traffic']['text'] ?? '100 min';

                    $dataReference = [
                        'objectId' => $reference->objectId,
                        'newTimeGoogle' => $dataGoogle,
                    ];
                    //send new time to parse server
                    $responseParseServer = $clientParse->request('post', 'patchTimeGoogleForReference', [
                        "body" => json_encode($dataReference),
                    ]);
                    Log::debug($responseParseServer->getBody()->getContents());
                }

                # code...
            }
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode() ?? 500);
        }
        // Log::debug(json_encode($dataBorder, JSON_PRETTY_PRINT) . "\n");
    }
}
