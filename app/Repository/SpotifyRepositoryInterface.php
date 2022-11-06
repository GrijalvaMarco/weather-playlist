<?php
namespace App\Repository;

use App\Models\Category;
use Illuminate\Support\Collection;

interface SpotifyRepositoryInterface
{
   public function all(): Collection;
}