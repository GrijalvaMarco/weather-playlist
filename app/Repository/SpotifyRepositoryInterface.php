<?php
namespace App\Repository;

use App\Models\Category;
use Illuminate\Support\Collection;

interface SpotifyRepositoryInterface
{
   public function all(): Collection;

   public function getRecommendedPlaylist($category_name); //Getting a playlist with tracks randomized by category
}