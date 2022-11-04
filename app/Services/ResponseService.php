<?php

namespace App\Services;

class ResponseService
{
    public static function format(string $city)
    {
        $dataFetch = new DataFetchService();
        $response = $dataFetch->getCurrentWeather($city);

        return[ 'success' => true,'response' =>  json_decode($response)];
    }
}
