<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class pageController extends Controller
{
    public function home() 
    {

        return view('welcome');

    }

    public function songs() 
    {
        $songs = \App\song::all();

        return view('songs',compact('songs'));

    }

    public function create()
    {

        return view('create');

    }

    public function store()
    {

        $song = new \App\song;
        $song->name = request()->name;
        $song->save();
        return redirect("/songs");

    }
}
