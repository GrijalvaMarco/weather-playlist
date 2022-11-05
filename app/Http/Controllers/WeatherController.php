<?php

namespace App\Http\Controllers;

use App\Services\ResponseService;
use App\Http\Requests\WeatherGetRequest;
use Illuminate\Http\JsonResponse;

class WeatherController extends Controller
{
    /**
     *@param WeatherGetRequest $request
     * @return JsonResponse
     */
    public function index(WeatherGetRequest $request)
    {
        $response = ResponseService::format($request);
        // echo($data);
        return response()->json($response,$response['code']);
    }
}
