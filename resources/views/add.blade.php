@extends('layout')

@section('content')

    <h1>
        Pick a Track
    </h1>
    @foreach ($tracks as $track)

        

        <form method="POST" action="\songs">

            {{ csrf_field() }}

            <input type="hidden" name="name" value="{{ $track->name }}" />
            <input type="hidden" name="artist" value="{{ $track->artists[0]->name }}" />
            <input type="hidden" name="uri" value="{{ $track->uri }}" />

            <button type="submit">{{ $track->name }} by {{ $track->artists[0]->name }}</button>
        </form>

    @endforeach

@endsection