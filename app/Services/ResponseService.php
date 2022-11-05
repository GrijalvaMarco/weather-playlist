<?php

namespace App\Services;

class ResponseService
{
    public static function format(string $city)
    {
        $dataFetch = new DataFetchService();
        $response = [];
        $weatherResponse = $dataFetch->getCurrentWeather($city);
       
        if($weatherResponse['success'] == true) {
            $response = [
                'success' => true,
                'city' => $city,
                'current_weather' => $weatherResponse['data'],
                'recommended_playlist' => [],
                'code' => $weatherResponse['code']
                ];
        } else {
            $response = [
                'success' => false,
                'city' => $city,
                'error_message' => $weatherResponse['message'],
                'code' => $weatherResponse['code']
                ];
        }
        // $weather = json_decode($weatherResp)->main->temp;

        // print_r($weatherResp);
        return $response;
        
    }
}
