<?php

namespace App\Services;

use App\Enums\CategoryType;
use App\Repository\SpotifyRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Http\Requests\WeatherGetRequest;
class DataFetchService
{
    private $client;
    private $repository;
  
   public function __construct(SpotifyRepositoryInterface $repository)
   {
       $this->repository = $repository;
   }

    public function getCurrentWeather(WeatherGetRequest $request)
    {
        $client = new Client();
        if(isset($request->city)){
            $url = "https://api.openweathermap.org/data/2.5/weather?q=".$request->city."&units=metric&appid=".env('OPENWEATHER_API_KEY');
        } else {
            $url = "https://api.openweathermap.org/data/2.5/weather?lat=".$request->lat."&lon=".$request->lon."&units=metric&appid=".env('OPENWEATHER_API_KEY');
        }
        
        try {
            $response = json_decode($client->get($url)->getBody());
            $response = ['success' => true, 'data' => $response->main->temp, 'code' => 200];
        } catch (RequestException $e) {
            // throw new Exception($e);
            $response = ['success' => false, 'message' => $e->getMessage(), 'code' => $e->getCode()];
        }
        return $response;
    }

    /**
     *@param string $weather = temperature in celsius grades ejem:14.92
     * @return array
     */
    public function getRecommendedPlaylist($weather)
    {
        if ($weather > 30) {
            $playlists = $this->repository->getRecommendedPlaylist(CategoryType::PARTY);
        } elseif ($weather >= 15 && $weather <= 30) {
            $playlists = $this->repository->getRecommendedPlaylist(CategoryType::POP);
        } elseif ($weather >= 10 && $weather < 15) {
            $playlists = $this->repository->getRecommendedPlaylist(CategoryType::ROCK);
        } else {
            $playlists = $this->repository->getRecommendedPlaylist(CategoryType::CLASSICAL);
        }

        return $playlists;
    }

}
