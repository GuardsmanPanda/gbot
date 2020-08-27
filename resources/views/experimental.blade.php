@extends('layouts.layout')

@section('content')
    <div style="display: flex;justify-content: center;">
        <a class="btn btn-primary" href="https://id.twitch.tv/oauth2/authorize?client_id=q8q6jjiuc7f2ef04wmb7m653jd5ra8&redirect_uri=https://gman.bot/oauth/twitch&response_type=code&scope=user:read:email" role="button">Login With Twitch</a>
        Please note that this feature.
        a) Doesn't work yet.
        b) Will allow me to store your email address.
    </div>
    <div>
        Hello: {{ Auth::user()->name }}
    </div>
@endsection
