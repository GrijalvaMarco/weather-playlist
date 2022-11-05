<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Http\Requests\WeatherGetRequest;
class DataFetchService
{
    private $client;

    public function __construct()
    {
        $this->client = new Client();
    }

    public function getCurrentWeather(WeatherGetRequest $request)
    {
        // $client = new Client();
        if(isset($request->city)){
            $url = "https://api.openweathermap.org/data/2.5/weather?q=".$request->city."&units=metric&appid=".env('OPENWEATHER_API_KEY');
        } else {
            $url = "https://api.openweathermap.org/data/2.5/weather?lat=".$request->lat."&lon=".$request->lon."&units=metric&appid=".env('OPENWEATHER_API_KEY');
        }
        
        try {
            $response = json_decode($this->client->get($url)->getBody());
            $response = ['success' => true, 'data' => $response->main->temp, 'code' => 200];
        } catch (RequestException $e) {
            // throw new Exception($e);
            $response = ['success' => false, 'message' => $e->getMessage(), 'code' => $e->getCode()];
        }
        return $response;
    }

}
