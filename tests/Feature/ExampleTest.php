<?php

namespace Tests\Feature;

use Illuminate\Http\Response;
use Tests\TestCase;

class ExampleTest extends TestCase
{
    /**
     * A basic test example.
     *
     * @return void
     */
    public function test_example()
    {
        $response = $this->get('/');

        $response->assertStatus(200);
    }


    /**
     *
     * @test
     * @return void
     */
    public function it_can_get_playlist_successfully_by_city()
    {
        $response = $this->get('/api/playlist/recommended?city=zapopan');

        // Assert
        $response->assertStatus(Response::HTTP_OK)
            ->assertStatus(200)
            ->assertJsonStructure([
                'success', 'current_weather', 'recommended_playlist', 'code',
            ]);
    }

    /**
     *
     * @test
     * @return void
     */
    public function it_can_sync_spotify_playlist_successfully()
    {
        $response = $this->get('/api/spotify/sync');

        // Assert
        $response->assertStatus(Response::HTTP_OK)
            ->assertStatus(200)
            ->assertJson([
                'success' => true,
                'code' => 200
            ]);
    }
}
