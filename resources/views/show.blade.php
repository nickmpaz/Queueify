
@extends('layout')

@section('content')
    <h1>
        {{ $song->name }}
    </h1>
    <div>
        <form method="GET" action="/songs/{{ $song ->id }}/edit">
            <button tpye = "submit">
                EDIT 
            </button>
        </form>
        <form method="GET" action="/songs/{{ $song ->id }}/push">
            <button tpye = "submit">
                Push 
            </button>
        </form>
        <form method="POST" action="/songs/{{ $song ->id }}">
            {{ method_field('DELETE') }}
            {{ csrf_field() }}
            <button type="submit">
            DELETE
        </button>
    </div>
@endsection
