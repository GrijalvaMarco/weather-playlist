<?php

namespace App\Services;
use App\Http\Requests\WeatherGetRequest;
use App\Repository\SpotifyRepositoryInterface;
class ResponseService
{
//     private $repository;
  
//    public function __construct(SpotifyRepositoryInterface $repository)
//    {
//        $this->repository = $repository;
//    }
    public static function format(WeatherGetRequest $request, SpotifyRepositoryInterface $repository)
    {
        $dataFetch = new DataFetchService($repository);
        $weather_response = $dataFetch->getCurrentWeather($request);

        $response = [
            'success' => true,
            'data' => $weather_response,
            'code' => 200
            ];

        // $dataFetch = new DataFetchService();
        // $response = [];
        // $weather_response = $dataFetch->getCurrentWeather($request);

        // if($weather_response['success'] == true) {
        //     $recommended_playlist = [];     

        //     $response = [
        //         'success' => true,
        //         'current_weather' => $weather_response['data'],
        //         'recommended_playlist' => $recommended_playlist,
        //         'code' => $weather_response['code']
        //         ];
        // } else {
        //     $response = [
        //         'success' => false,
        //         'error_message' => $weather_response['message'],
        //         'code' => $weather_response['code']
        //         ];
        // }

        // $spotifyRequest = new SpotifyService();
        // $token = $spotifyRequest->getToken();

        // // $response = $spotifyRequest->getCategories($token);
        // $response = $spotifyRequest->getPlaylists($token,"0JQ5DAqbMKFA6SOHvT3gck");

        return $response;
        
    }
}
