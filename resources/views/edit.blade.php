

@extends('layout')

@section('content')
    <h1>
        {{ $song->name }}
    </h1>
    
    <form method="POST" action="/songs/{{ $song ->id }}">

        {{ method_field('PATCH') }}
        {{ csrf_field() }}

        <input type="text" name="name" placeholder="name">

        <button type="submit">
            update this song
        </button>
    </form>
@endsection