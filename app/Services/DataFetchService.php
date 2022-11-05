<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
class DataFetchService
{

    public function getCurrentWeather(string $city)
    {
        $client = new Client();
        $url = "https://api.openweathermap.org/data/2.5/weather?q=".$city."&units=metric&appid=".env('OPENWEATHER_API_KEY');
        
        try {
            $response = json_decode($client->get($url)->getBody());
            $response = ['success' => true, 'data' => $response->main->temp, 'code' => 200];
        } catch (RequestException $e) {
            // throw new Exception($e);
            $response = ['success' => false, 'message' => $e->getMessage(), 'code' => $e->getCode()];
        }
        return $response;
    }
}
