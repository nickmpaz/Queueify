<?php

namespace App\Providers;

use Illuminate\Support\ServiceProvider;

class SpotifyServiceProvider extends ServiceProvider
{
    /**
     * Register services.
     *
     * @return void
     */
    public function register()
    {
        /*
        $this->app->singleton('SpotifyWebApi\SpotifyWebApi', function ($app) {
            $client = new SpotifyWebApi\SpotifyWebApi;

            $session = new SpotifyWebAPI\Session(
                env('SPOTIFY_CLIENT_ID'),
                env('SPOTIFY_CLIENT_SECRET'),
                env('SPOTIFY_CALLBACK_URL')
            );

            $scopes = [
                'playlist-read-private',
                'user-read-private',
            ];

            $session->requestCredentialsToken($scopes);

            $accessToken = $session->getAccessToken();

            $client->setAccessToken($accessToken);

            return $client;
        });*/

        
        $this->app->singleton('SpotifyWebAPI', function ($app) {
            
            $client = new \SpotifyWebAPI\SpotifyWebAPI;
            
            $client_id = \config('spotify.client');
            $client_secret = \config('spotify.secret');
            $session = new \SpotifyWebAPI\Session(
                $client_id,
                $client_secret
            );

            $session->requestCredentialsToken();

            $accessToken = $session->getAccessToken();

            $client->setAccessToken($accessToken);

            return $client;

        });

    }

    /**
     * Bootstrap services.
     *
     * @return void
     */
    public function boot()
    {
        //
    }
}
