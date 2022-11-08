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
     * @OA\Get(
     *    path="/playlist/recommended",
     *    operationId="index",
     *    tags={"Playlists"},
     *    summary="Get playlist and tracks depends the weather",
     *    description="Get playlist and tracks sending a city or coordinates",
     *    @OA\Parameter(name="city", in="query", description="city is required or coordinates instead", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *    @OA\Parameter(name="lat", in="query", description="latitude required if city is not present", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *    @OA\Parameter(name="lon", in="query", description="longitude required if city is not present", required=false,
     *        @OA\Schema(type="string")
     *    ),
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="code", type="integer", example="200"),
     *             @OA\Property(property="success", type="bool", example="true"),
     *             @OA\Property(property="current_weather", type="float", example="22.86"),
     *             @OA\Property(property="recommended_playlist",type="object")
     *          )
     *       )
     *  )
     */
    public function index(WeatherGetRequest $request)
    {
        $response = ResponseService::format($request, $this->repository);
        return response()->json($response, $response['code']);
    }
}
