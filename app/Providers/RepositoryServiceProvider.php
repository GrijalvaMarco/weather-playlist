<?php 

namespace App\Providers; 

use App\Repository\EloquentRepositoryInterface; 
use App\Repository\SpotifyRepositoryInterface; 
use App\Repository\Eloquent\SpotifyRepository; 
use App\Repository\Eloquent\BaseRepository; 
use Illuminate\Support\ServiceProvider; 

/** 
* Class RepositoryServiceProvider 
* @package App\Providers 
*/ 
class RepositoryServiceProvider extends ServiceProvider 
{ 
   /** 
    * Register services. 
    * 
    * @return void  
    */ 
   public function register() 
   { 
    //    $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
       
        $this->app->bind(EloquentRepositoryInterface::class, BaseRepository::class);
        $this->app->bind(SpotifyRepositoryInterface::class, SpotifyRepository::class);
   }
}