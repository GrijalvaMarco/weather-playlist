<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Playlist;
use App\Models\Track;
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
        // $client = new Client();
        // if(isset($request->city)){
        //     $url = "https://api.openweathermap.org/data/2.5/weather?q=".$request->city."&units=metric&appid=".env('OPENWEATHER_API_KEY');
        // } else {
        //     $url = "https://api.openweathermap.org/data/2.5/weather?lat=".$request->lat."&lon=".$request->lon."&units=metric&appid=".env('OPENWEATHER_API_KEY');
        // }
        // $categories = $this->repository->all();
        $playlists = Track::with('playlist','playlist.category')->get();
        $response = ['success' => true, 'data' => $playlists, 'code' => 200];
        // try {
        //     $response = json_decode($this->client->get($url)->getBody());
        //     $response = ['success' => true, 'data' => $response->main->temp, 'code' => 200];
        // } catch (RequestException $e) {
        //     // throw new Exception($e);
        //     $response = ['success' => false, 'message' => $e->getMessage(), 'code' => $e->getCode()];
        // }
        return $response;
    }

}
