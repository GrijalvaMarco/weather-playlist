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
    public function sync()
    {
        $service =  new SpotifyService($this->repository);
        $response = $service->sync($this->repository);

        return response()->json($response,200);
    }
}
