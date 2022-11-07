<?php

namespace App\Http\Controllers;

use App\Repository\SpotifyRepositoryInterface;
use App\Services\ResponseService;
use App\Http\Requests\WeatherGetRequest;
use App\Services\SpotifyService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class WeatherController extends Controller
{
    private $repository;
  
   public function __construct(SpotifyRepositoryInterface $repository)
   {
       $this->repository = $repository;
   }
    /**
     *@param WeatherGetRequest $request
     * @return JsonResponse
     */
    public function index(WeatherGetRequest $request)
    {
        $response = ResponseService::format($request,$this->repository);
        return response()->json($response,$response['code']);
    }
}
