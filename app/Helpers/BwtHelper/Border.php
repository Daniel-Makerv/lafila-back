<?php

namespace App\Helpers\BwtHelper;

use Exception;
use GuzzleHttp\Client;

class Border
{
    public static function getClient()
    {
        return new Client([
            'base_uri' => config("app.bwt_api_url"),
        ]);
    }

    public static function getBorderWidthCords($uno, $dos, $tres, $line)
    {
        try {
            $client = self::getClient();

            $response = $client->get("/{$uno}, {$dos}, {$tres}/{$line}");
            $content = $response->getBody()->getContents();
            $xml = simplexml_load_string($content);
        } catch (\Exception $err) {
            return throw new Exception("Error: " . $err->getMessage(), 500);
        }

        return $xml;
    }
}
