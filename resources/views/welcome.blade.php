@extends('layouts.layout')

@section('content')
    <div style="display: flex;justify-content: center;"><h1>BoT &Pi; -- I am {{ $test }}&deg;</h1></div>
    <iframe src="https://streamlabs.com/widgets/chat-box/v1/4D7CDE523290354083D7" height="200" width="900"></iframe>
@endsection
