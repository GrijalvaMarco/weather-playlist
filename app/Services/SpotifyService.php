<?php

namespace App\Services;

use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use App\Http\Requests\WeatherGetRequest;
class SpotifyService
{
    private $client;
    private $spotify_url;

    public function __construct()
    {
        $this->client = new Client();
        $this->spotify_url = "https://api.spotify.com/v1/";
    }

    public function getToken()
    {
        $client_id = env('CLIENT_ID');
        $client_secret = env('CLIENT_SECRET');
       
        $url = "https://accounts.spotify.com/api/token";
        $basic = base64_encode($client_id.':'.$client_secret);

        try {
            $response = json_decode($this->client->post($url,
            [
                'headers' => [
                    'Authorization' => 'Basic '.$basic,
                    'Content-Type' => 'application/x-www-form-urlencoded'
                ],
                'form_params'=> ['grant_type' => 'client_credentials']
            ])->getBody());
            $token = $response->access_token;
            
            $response = $token;
        } catch (RequestException $e) {
            // throw new Exception($e);
            $response = ['success' => false, 'message' => $e->getMessage(), 'code' => $e->getCode()];
        }
        return $response;
    }

    public function getCategories($token)
    {       
        $url =$this->spotify_url."browse/categories?limit=50";

        try {
            $response = json_decode($this->client->get($url,
            [
                'headers' => [
                    'Authorization' => 'Bearer '.$token,
                    'Content-Type' => 'application/json'
                ]
            ])->getBody());
            
            $response = ['success' => true, 'data' => $response, 'code' => 200];
        } catch (RequestException $e) {
            $response = ['success' => false, 'message' => $e->getMessage(), 'code' => $e->getCode()];
        }
        return $response;
    }

}
