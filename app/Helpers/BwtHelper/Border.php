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
use Illuminate\Support\Facades\Xml;

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

            // // Acceder a los items
            // foreach ($xml->channel->item as $item) {
            //     $title = (string)$item->title;
            //     $description = (string)$item->description;
            //     $link = (string)$item->link;
            //     $pubDate = (string)$item->pubDate;
            //     $guid = (string)$item->guid;
            //     $pedestrian = (string)$item->h4;

            //     // Aquí puedes trabajar con los datos del item según tus necesidades
            //     Log::debug($title);
            //     Log::debug($description);
            //     Log::debug($link);
            //     Log::debug($pubDate);
            //     Log::debug($guid);
            //     Log::debug($pedestrian);
            // }


            $transformDataBordersTojson = json_encode($xml);
            $bordersJson = json_decode($transformDataBordersTojson, true);

            $bordersJobs = [];

            Log::debug($borders);

            foreach ($bordersJson['channel']['item'] as $border) {
                // $bordersJobs[] = ProcessInsertBorder::dispatch((object)$border)->onQueue('bwt');
                $bordersJobs[] = ProcessInsertBorder::dispatch((object)$border)->onQueue('bwt')->delay(now()->addMinutes(random_int(1, 7)));
            }
        } catch (\Exception $err) {
            return throw new Exception("Error: " . $err->getMessage() . $err->getFile() . $err->getLine(), 500);
        }
        return "listo";
    }

    public static function getTimePassengerVehicles($description, $search)
    {
        try {
            preg_match("/{$search}: At ([^ ]+)/", $description, $atMatches);
            $result = isset($atMatches[1]) ? $atMatches[1] : null;
        } catch (\Exception $err) {
            Log::error("error: " . $err->getMessage());
        }
        return $result;
    }

    public static function getOpenLinesByline($description, $search)
    {
        try {
            preg_match("/{$search}:.*?(\d+) lane\(s\) open/", $description, $generalLanesMatches);
            // Verificar si hay "Lanes Closed" después del valor
            if (strpos($description, "{$search}:  Lanes Closed") !== false) {
                Log::debug("es cero ");
                return 0;
            }
            $result = isset($generalLanesMatches[1]) ? $generalLanesMatches[1] : null;
        } catch (\Exception $err) {
            Log::error("error: " . $err->getMessage());
        }
        return $result;
    }

    public static function getStatusForLine($description, $search)
    {
        try {
            preg_match("/{$search}:.*?(open|Closed)/", $description, $matches);
            $words = explode(' ', $matches[0]);
            $matches = end($words);
        } catch (\Exception $err) {
            Log::error("error: " . $err->getMessage());
        }
        return $matches == 'open' ? 'open' : 'closed';
    }
}
