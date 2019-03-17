<?php

namespace App\Http\Controllers;
use App\song;
use Illuminate\Http\Request;
//use \SpotifyWebAPI\SpotifyWebAPI;

class SongsController extends Controller
{
    /*
    public function __construct(\SpotifyWebAPI\SpotifyWebAPI $client)
    {
        $this->spotify = $client;
        $session = new \SpotifyWebAPI\Session(
            '99cbf2177bb04f76b71b7de6f87fbdc6',
            '1c4da42567b44d51892506f5a469cac6'
        );
        $session->requestCredentialsToken();
        $accessToken = $session->getAccessToken();
        $client->setAccessToken($accessToken);
    }*/
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        
        $songs = song::all();
        return view('songs',compact('songs'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('create');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $song = new \App\song;
        $song->name = request()->name;
        $song->artist = request()->artist;
        $song->uri = request()->uri;
        $song->position = song::max('position') + 1;
        $song->save();
        return redirect("/songs");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {

        $song = song::find($id);

        return view("show", compact('song'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $song = song::find($id);

        return view("edit", compact('song'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        
        $song = song::find($id);
        $song->name = request()->name;
        $song->artist = request()->artist;
        $song->save();
        return redirect("/songs");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $song = song::find($id);
        $pos = $song->position;
        $song->delete();
        $songsToMove = song::where('position', '>', $pos)->get();

        foreach($songsToMove as $song) {

            $song->position -= 1;
            $song->save();

        }

        return redirect("/songs");
    }

    public function push($id) {

        $song = song::find($id);
        $pos = $song->position;
        $songsToMove = song::where('position', '<', $pos)->get();
        $song->position = 1;
        $song->save();

        foreach($songsToMove as $push) {

            $push->position += 1;
            $push->save();

        }

        return redirect("/songs");

    }

    public function clear() {

        $songs = song::all();
        foreach($songs as $song) {
            $song->delete();
        }
        return redirect("/songs");
    }

    public function add(Request $request) {

        $search = request()->name;
        $results = app('SpotifyWebAPI')->search("$search", 'track');
        $tracks = $results->tracks->items;
        
        return view('add', compact('tracks'));

    }
}
