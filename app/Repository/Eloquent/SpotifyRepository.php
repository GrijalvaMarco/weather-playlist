<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Models\Playlist;
use App\Repository\SpotifyRepositoryInterface;
use Illuminate\Support\Collection;

class SpotifyRepository extends BaseRepository implements SpotifyRepositoryInterface
{

   /**
    * SpotifyRepository constructor.
    *
    * @param Category $model
    */
   public function __construct(Category $model)
   {
       parent::__construct($model);
   }

   /**
    * @return Collection
    */
   public function all(): Collection
   {
       return $this->model->with('playlists','playlists.tracks')->get();
   }

   public function getRecommendedPlaylist($category_id)
   {
        return Playlist::select('id','spotify_id','name','description','href')->inRandomOrder()
        ->where('category_id',$category_id)->with('tracks')->first();
   }
}