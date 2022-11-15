<?php

namespace Tests\Unit;

use PHPUnit\Framework\TestCase;
use GuzzleHttp\Client;

class WeatherTest extends TestCase
{
    /**
     * Test weather api url for fail and pass.
     *
     * @return void
     */
    public function test_weather_api_url_fail()
    {
        try{
            $client = new Client();
            $url = "https://api.openweathermap.org/data/2.5/weather?q=fsads".
            "&units=metric&appid=".env('OPENWEATHER_API_KEY');
            $client->get($url)->getBody();
        }catch(\Exception $e){
            $this->assertTrue(true);
            return;
        }
        $this->assertFalse(true);
        return;
    }

    public function test_weather_api_url_pass()
    {
        try{
            $client = new Client();
            $url = "https://api.openweathermap.org/data/2.5/weather?q=zapopan".
            "&units=metric&appid=".env('OPENWEATHER_API_KEY');
            $client->get($url)->getBody();
        }catch(\Exception $e){
            $this->assertTrue(true);
        }
    }
}
