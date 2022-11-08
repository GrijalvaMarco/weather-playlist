<?php

namespace App\Http\Controllers;

use App\Repository\SpotifyRepositoryInterface;
use App\Services\SpotifyService;

class SpotifyController extends Controller
{
    private $repository;
  
   public function __construct(SpotifyRepositoryInterface $repository)
   {
       $this->repository = $repository;
   }

   /**
     * @OA\Get(
     *    path="/spotify/sync",
     *    operationId="sync",
     *    tags={"Spotify"},
     *    summary="Synchronize spotify data",
     *    description="Request to spotify's api and save playlists and tracks into database",
     *     @OA\Response(
     *          response=200, description="Success",
     *          @OA\JsonContent(
     *             @OA\Property(property="code", type="integer", example="200"),
     *             @OA\Property(property="success",type="bool", example="true")
     *          )
     *       )
     *  )
     */
    public function sync()
    {
        $service =  new SpotifyService($this->repository);
        $response = $service->sync($this->repository);

        return response()->json($response,200);
    }
}
