@extends('layouts.layout')

@section('content')
    <div style="display: flex;justify-content: center;">
        <h1>Here Be Dragons</h1>
    </div>
    <div>
        {{Auth::user()->tui_data->flag}}
    </div>
    <div>
        @foreach($flags as $flag)
            <div><a href="/admin/flag-selector?set-flag={{$flag}}"><img src="/static/img/flags/{{$flag}}.png">{{$flag}}</a></div>
        @endforeach
    </div>
@endsection
