<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
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
       return $this->model->all();    
   }
}