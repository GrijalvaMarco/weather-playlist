<?php

namespace App\Http\Controllers;

use App\Services\ResponseService;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
    /**
     * @param string $city
     * @return JsonResponse
     */
    public function index($city)
    {
        $response = ResponseService::format($city);
        // echo($data);
        return response()->json($response,$response['code']);
    }
}
