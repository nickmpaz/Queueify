

@extends('layout')

@section('content')
    <h1>
        Search Spotify:
    </h1>
    <form method=POST action=\songs\add>

        {{ csrf_field() }}
        <div>
            <input type="text" name="name" placeholder="name">
                
        </div>
            
        <div>
            <button type="submit">
                Search
            </button>
        </div>

        <div>

        </div>

    </form>
@endsection