<?php

namespace App\Services;
use App\Http\Requests\WeatherGetRequest;
use App\Models\ClientRequest;
use App\Repository\SpotifyRepositoryInterface;
class ResponseService
{
    public static function format(WeatherGetRequest $request, SpotifyRepositoryInterface $repository)
    {
        $dataFetch = new DataFetchService($repository);
        $weather_response = $dataFetch->getCurrentWeather($request);
        
        if($weather_response['success'] == true) {
            $weather = $weather_response['data']->main->temp;
            $recommended_playlist = $dataFetch->getRecommendedPlaylist($weather);

            //Save statistics
            $client_request = [
                'ip_address' => request()->ip(),
                'user_agent' => $request->header('User-Agent'),
                'weather_info' => $weather_response['data'],
                'city' => $request->city,
                'coordinates' => $request->lat ? ['lat' => $request->lat, 'lon' => $request->lon]: null,
                'playlist_recommended_id' => $recommended_playlist->id,
            ];
            ClientRequest::create($client_request);

            //Request Response
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
