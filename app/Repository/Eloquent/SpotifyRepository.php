<?php

namespace App\Repository\Eloquent;

use App\Models\Category;
use App\Models\Playlist;
use App\Models\Track;
use App\Repository\SpotifyRepositoryInterface;
use Illuminate\Support\Collection;
use Exception;
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

    /**
    * @return 
    */
   public function insertPlaylist($data)
   {
    $playlist = Playlist::firstOrCreate($data);
    return ['wasRecentlyCreated' => $playlist->wasRecentlyCreated, 'id' => $playlist->id];
   }

   /**
    * @return void
    */
    public function insertTracks($data): void
    {
        try {
            $tracks = $data['tracks'];
            $playlist_id = $data['playlist_id'];

            foreach ($tracks as $item) {
                $track_list[] = [
                    'playlist_id' => $playlist_id,
                    'spotify_id' => $item->track->id,
                    'name' => $item->track->name,
                    'href' => $item->track->href,
                    'artists' => json_encode($item->track->artists),
                ];
            }
            Track::insert($track_list);
        } catch (Exception $e) {
            throw new Exception($e);
        }
    }
}