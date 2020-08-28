@extends('layouts.layout')

@section('content')
    <div style="display: flex;justify-content: center;">
        <h1>Here Be Dragons</h1>
    </div>
    <div>
        {{Auth::user()->tui->flag}}
    </div>
@endsection
