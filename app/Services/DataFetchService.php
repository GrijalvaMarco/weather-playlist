<?php

namespace App\Services;

use Exception;
use GuzzleHttp\Client;
class DataFetchService
{

    public function getCurrentWeather(string $city)
    {
        $client = new Client();
        $url = "https://api.openweathermap.org/data/2.5/weather?q=".$city."&appid=".env('OPENWEATHER_API_KEY');
        
        try {
            $response = $client->get($url)->getBody();
        } catch (Exception $e) {
            throw new Exception($e);
        }
        return $response;
    }
}
