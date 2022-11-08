<?php

namespace App\Services;

use App\Models\Category;
use App\Models\Playlist;
use App\Repository\SpotifyRepositoryInterface;
use GuzzleHttp\Client;
use GuzzleHttp\Exception\RequestException;
use Exception;

class SpotifyService
{
    private $client;
    private $spotify_url;
    private $repository;
  
    /**
     *@method Inject spotify repository in order to call query methods
     */
    public function __construct(SpotifyRepositoryInterface $repository)
    {
        $this->client = new Client();
        $this->spotify_url = "https://api.spotify.com/v1/";
        $this->repository = $repository;
    }

    public function getToken()
    {
        $client_id = env('CLIENT_ID');
        $client_secret = env('CLIENT_SECRET');
       
        $url = "https://accounts.spotify.com/api/token";
        $basic = base64_encode($client_id.':'.$client_secret);

        try {
            $response = json_decode($this->client->post($url, ['headers' => ['Authorization' => 'Basic '.$basic,
            'Content-Type' => 'application/x-www-form-urlencoded'],
            'form_params'=> ['grant_type' => 'client_credentials']])->getBody());
            $token = $response->access_token;
            
            $response = $token;
        } catch (RequestException $e) {
            throw new Exception($e);
        }
        return $response;
    }

    public function getCategories($token)
    {
        $url =$this->spotify_url."browse/categories?limit=50";

        try {
            $response = json_decode($this->client->post($url, ['headers' => ['Authorization' => 'Bearer '.$token,
            'Content-Type' => 'application/json']])->getBody());
            
            $response = ['success' => true, 'data' => $response, 'code' => 200];
        } catch (RequestException $e) {
            throw new Exception($e);
        }
        return $response;
    }

    /**
     * Get playlists from spotify api.
     *@param $token
     *@param string $category_sid = spotify_id of the category
     * @return array
     */

    public function getPlaylists($token, $category_sid)
    {
        $url = $this->spotify_url."browse/categories/".$category_sid."/playlists?limit=1";

        try {
            $response = json_decode($this->client->post($url, ['headers' => ['Authorization' => 'Bearer '.$token,
            'Content-Type' => 'application/json']])->getBody());

            $response = $response->playlists->items;
        } catch (RequestException $e) {
            throw new Exception($e);
        }
        return $response;
    }

    /**
     * Get Tracks of a playlist.
     *@param $token
     *@param string $playlist_sid = spotify_id of the playlist
     * @return array
     */
    public function getTracks($token, $playlist_sid)
    {
        $url = $this->spotify_url."playlists/".$playlist_sid;

        try {
            $response = json_decode($this->client->post($url, ['headers' => ['Authorization' => 'Bearer '.$token,
            'Content-Type' => 'application/json']])->getBody());
            $response = $response->tracks->items;
        } catch (RequestException $e) {
            throw new Exception($e);
        }
        return $response;
    }


    /**
     * Get Playlists and tracks from spotify api and save in database or update.
     * This method could be called from a task scheduled
     * @return array
     */
    public function sync(SpotifyRepositoryInterface $repository)
    {
        $token =  $this->getToken();
        $local_categories = Category::select('id', 'name', 'spotify_id')->where('status', true)->get();
       
        foreach ($local_categories as $category) {
            $playlists = $this->getPlaylists($token, $category->spotify_id);

            foreach ($playlists as $playlist) {
                $tracks = $this->getTracks($token, $playlist->id);
                
                $playlist_data = [
                    'category_id' => $category->id,
                    'spotify_id' => $playlist->id,
                    'name' => $playlist->name,
                    'description' => $playlist->description,
                    'href' => $playlist->href,
                    'tracks' => json_encode($playlist->tracks)
                ];
                $playlist_response = $this->repository->insertPlaylist($playlist_data);

                if ($playlist_response['wasRecentlyCreated']) {
                    $track_data = [
                        'playlist_id' => $playlist_response['id'],
                        'tracks' => $tracks
                    ];
                    $this->repository->insertTracks($track_data);
                }
            }
        }

        return ['success' => true, 'code' => 200];
    }
}
