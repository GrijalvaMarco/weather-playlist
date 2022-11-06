<?php

namespace App\Services;
use App\Http\Requests\WeatherGetRequest;
use App\Repository\SpotifyRepositoryInterface;
class ResponseService
{
    public static function format(WeatherGetRequest $request, SpotifyRepositoryInterface $repository)
    {
        $dataFetch = new DataFetchService($repository);
        $weather_response = $dataFetch->getCurrentWeather($request);
        
        if($weather_response['success'] == true) {
            $weather = $weather_response['data'];
            $recommended_playlist = $dataFetch->getRecommendedPlaylist($weather);

            $response = [
                'success' => true,
                'current_weather' => $weather,
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
