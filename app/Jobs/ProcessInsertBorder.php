<?php

namespace App\Jobs;

use App\Helpers\BwtHelper\Border;
use Carbon\Carbon;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldBeUnique;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Log;

use function Psl\Type\object;

// use Illuminate\Bus\Batchable;

class ProcessInsertBorder implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    protected $border;

    /**
     * Create a new job instance.
     */
    public function __construct($border)
    {
        $this->border = $border;
    }

    /**
     * Execute the job.
     */
    public function handle(): void
    {

        Log::debug(json_encode($this->border->description));

        //hours openingTime and closingTime
        preg_match('/Hours: (\d+) am-(\d+) pm/', $this->border->description, $matches);
        $openingTime = isset($matches[1]) ? $matches[1] : null;
        $closingTime = isset($matches[2]) ? $matches[2] : null;

        switch (true) { //validate hours for xml date
            case strpos($this->border->description, 'Hours: 24 hrs/day') !== false:
                $openingTime = 24;
                $closingTime = 24;
                break;
            case strpos($this->border->description, 'Hours: 6 am-Midnight') !== false:
                $openingTime = 6;
                $closingTime = 10;
            default:
                # code...
                break;
        }
        //maximun lanes 
        preg_match('/Maximum Lanes: (\d+)/', $this->border->description, $maxLanesMatches);
        $maxLanes = isset($maxLanesMatches[1]) ? $maxLanesMatches[1] : null;

        //dataAccess
        $accessData = (object)[
            'openingTime' => $openingTime,
            'closingTime' => $closingTime,
            'maximumLanes' => (int)$maxLanes,
            //general line
            'atGeneralLine' => (int)Border::getTimePassengerVehicles($this->border->description, 'General Lanes'),
            'openLinesGeneral' => (int)Border::getOpenLinesByline($this->border->description, 'General Lanes'),
            //ready line
            'atReadyLine' => (int)Border::getTimePassengerVehicles($this->border->description, 'Ready Lanes'),
            'openLinesReadyLine' => (int)Border::getOpenLinesByline($this->border->description, 'Ready Lanes'),
            //sentry line
            'atSentryLine' => (int)Border::getTimePassengerVehicles($this->border->description, 'Sentri Lanes'),
            'openLinesSentryLine' => (int)Border::getOpenLinesByline($this->border->description, 'Sentri Lanes'),
            //lines open
            'openLanes' => (int)Border::getOpenLinesByline($this->border->description, 'Sentri Lanes'),

        ];

        $dataBorder = (object)[
            'title' => $this->border->title,
            'publishDate' => $this->border->pubDate,
            'isoDate' => Carbon::createFromFormat('D, d M Y H:i:s e', $this->border->pubDate),
            'openingTime' => $accessData->openingTime,
            'closingTime' => $accessData->closingTime,
            'passengerVehicles' => (object)[
                'maximumLanes' => $accessData->openLinesGeneral + $accessData->openLinesReadyLine + $accessData->openLinesSentryLine,
                'general' => (object)[
                    'at' => $accessData->atGeneralLine,
                    'delay' => "8",
                    // 'openLanes' => $accessData->openLinesGeneral,
                    'openLanes' => $accessData->openLinesGeneral + $accessData->openLinesReadyLine,
                    'isOpen' => Border::getStatusForLine($this->border->description, 'General Lanes'),
                ],
                'readyLane' => (object)[
                    'at' => $accessData->atReadyLine,
                    'delay' => "10",
                    'openLanes' => $accessData->openLinesReadyLine,
                    'isOpen' => Border::getStatusForLine($this->border->description, 'Ready Lanes'),
                ],
                'sentry' => (object)[
                    'at' => $accessData->atSentryLine,
                    'delay' => "9",
                    'openLanes' => $accessData->openLinesSentryLine,
                    'isOpen' => Border::getStatusForLine($this->border->description, 'Sentri Lanes'),
                ],
            ],
            //Pedestrian
        ];

        if ($this->border->title == 'Hidalgo/Pharr - Hidalgo') {
            $pattern = '/General Lanes:(.*?lane\(s\)[^Maximum]+)/';
            preg_match_all($pattern, $this->border->description, $matchevs);
            $generalLanesArray = array_map('trim', $matchevs[1]);

            preg_match('/(\d+)\s+lane\(s\)/', $generalLanesArray[1], $matchesGeneral);

            // $generalLinesPedestrian = isset($matchesGeneralLinesPedestrian[1]) ? $matchesGeneralLinesPedestrian[1] : null;

            $dataPedestrian = (object)[
                'maximumLanes' => (int)$matchesGeneral[1],
                'general' => (object)[
                    'at' => $accessData->atGeneralLine,
                    'delay' => 1,
                    'openLanes' => (int)$matchesGeneral[1],
                    'isOpen' => 'open',
                ],
                'readyLane' => (object)[
                    'at' => $accessData->atReadyLine,
                    'delay' => 1,
                    'openLanes' => 0,
                    'isOpen' => 'close'
                ],
            ];
            $dataBorder->pedestrian = $dataPedestrian;
        }

        //send data to endpoint parse server
        $client = new Client([
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
            $form = [
                'data' => $dataBorder
            ];

            $response = $client->request('post', 'apiSaveBwt', [
                "body" => json_encode($form),
            ]);
        } catch (\Exception $exception) {
            throw new Exception($exception->getMessage(), $exception->getCode() ?? 500);
        }
        // Log::debug(json_encode($dataBorder, JSON_PRETTY_PRINT) . "\n");

        Log::debug($response->getBody()->getContents());
    }
}
