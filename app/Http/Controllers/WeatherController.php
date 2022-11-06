<?php

namespace App\Http\Controllers;

use App\Repository\SpotifyRepositoryInterface;
use App\Services\ResponseService;
use App\Http\Requests\WeatherGetRequest;
use Illuminate\Http\JsonResponse;

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
        // $response = $this->repository->all();
        // echo($data);
        return response()->json($response,200);
    }
}
