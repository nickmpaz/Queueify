
@extends('layout')

@section('head')
<meta http-equiv="refresh" content="10" /> 

@endsection

@section('content')
    <h1>
        Songs:  
    </h1>
    
    <div>
        <table class="table">
            <thead>
                <tr>
                    <th scope="col">#</th>
                    <th scope="col">Name</th>
                    <th scope="col">Artist</th>
                    <th scope="col">Track Number</th>
                    <th scope="col">push</th>
                    <th scope="col">delete</th>
                    <th scope="col">POSITION (temp)</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $next = 1
                @endphp
                @foreach($songs as $s)
                    @php
                        $pos = $loop->index + 1;
                        $next = $pos + 1;
                        $currentSong = \App\song::where('position', '=', $pos)->first();
                    @endphp
                    <tr>
                        <th scope="row">{{ $pos }}</th>
                        <td>
                            <a href="/songs/{{ $currentSong->id}}">
                            {{$currentSong->name}}
                            </a>
                        </td>
                        <td>
                            <p>
                            {{$currentSong->artist}}
                            </p>
                        </td>
                        <td>
                            <p>
                            {{$currentSong->uri}}
                            </p>
                        </td>
                        <td>
                            <form method="GET" action="/songs/{{ $currentSong ->id }}/push">
                                <button type = "submit">
                                    Push 
                                </button>
                            </form>
                        </td>
                        <td>
                            <form method="POST" action="/songs/{{ $currentSong ->id }}">
                                {{ method_field('DELETE') }}
                                {{ csrf_field() }}
                                <button type="submit">
                                    DELETE
                                </button>
                            </form>
                        </td>
                        <td>
                            {{ $currentSong->position }}
                        </td>
                        
                        
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>  

    <form method= 'GET' action="/songs/create">
        <button type="submit">add a song</button>
    </form>
    <form method="GET" action="/songs/clear">
        <button type="submit">Clear Songs</button>
    </form>

@endsection