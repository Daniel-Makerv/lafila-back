<?php

namespace App\Helpers\BwtHelper;

use App\Jobs\ProcessInsertBorder;
use Exception;
use GuzzleHttp\Client;
use Illuminate\Bus\Batch;
use Illuminate\Support\Facades\Bus;
use Illuminate\Support\Facades\Log;
use Saloon\XmlWrangler\Data\Element;
use Saloon\XmlWrangler\XmlWriter;
use Saloon\XmlWrangler\XmlReader;
use SimpleXMLElement;

class Border
{
    public static function getClient()
    {
        return new Client([
            'base_uri' => config("app.bwt_api_url"),
        ]);
    }

    public static function getBordersForBwt($coordinates, $line)
    {
        try {
            $client = self::getClient();

            $response = $client->get("bwtRss/HTML/-1/{$coordinates}/{$line}");
            $content = $response->getBody()->getContents();
            // $xml = simplexml_load_string($content);
        } catch (\Exception $err) {
            return throw new Exception("Error: " . $err->getMessage() . $err->getMessage() . $err->getFile() . $err->getLine(), 500);
        }
        return $content;
    }

    public static function transformDataForBorder($border)
    {
    }
    public static function storeBorderWidthCords($coordinates, $line)
    {

        try {
            $borders = self::getBordersForBwt($coordinates, $line);


            // Convertir el string XML en un objeto
            $xml = new SimpleXMLElement($borders);
            // Procesar cada <item>
            $bordersJobs = [];

            Log::debug("holaaa1");

            foreach ($xml->channel->item as $border) {
                Log::debug($border);
                Log::debug("holaaa");
                $bordersJobs[] = new ProcessInsertBorder($border);
            }

            $batch = Bus::batch($bordersJobs)->then(function (Batch $batch) {
                // All jobs completed successfully...
            })->catch(function (Batch $batch, Exception $e) {
                // First batch job failure detected...
            })->finally(function (Batch $batch) {
                // The batch has finished executing...
            })->dispatch();
        } catch (\Exception $err) {
            return throw new Exception("Error: " . $err->getMessage() . $err->getFile() . $err->getLine(), 500);
        }
        return "listo";
    }
}
