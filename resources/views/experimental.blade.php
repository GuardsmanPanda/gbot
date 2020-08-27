@extends('layouts.layout')

@section('content')
    <div style="display: flex;justify-content: center;">
        <h1>Here Be Dragons</h1>
    </div>
    <div>
        Hello: {{ Auth::user()->name }}
    </div>
@endsection
