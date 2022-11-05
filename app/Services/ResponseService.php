<?php

namespace App\Services;
use App\Http\Requests\WeatherGetRequest;
class ResponseService
{
    public static function format(WeatherGetRequest $request)
    {
        $dataFetch = new DataFetchService();
        $response = [];
        $weather_response = $dataFetch->getCurrentWeather($request);

        if($weather_response['success'] == true) {
            $recommended_playlist = [];     

            $response = [
                'success' => true,
                'current_weather' => $weather_response['data'],
                'recommended_playlist' => $recommended_playlist,
                'code' => $weather_response['code']
                ];
        } else {
            $response = [
                'success' => false,
                'error_message' => $weather_response['message'],
                'code' => $weather_response['code']
                ];
        }

        return $response;
        
    }
}
