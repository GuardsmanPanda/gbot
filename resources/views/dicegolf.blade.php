@extends('layouts.layout')

@section('content')
    <div class="ribbon-content">
        <h1 class="ribbon">Just a Rounded Ribbon</h1>
        <h5>Responsive? Resize the window.</h5>
        <div id="dg-stats"></div>
    </div>




    <script>
        const table = new Tabulator("#dg-stats", {
            ajaxURL: "/dicegolf/stats",
            layout:"fitColumns",
            columns:[
                {title:"ID", field:"id"},
                {title:"Length", field:"length"},
                {title:"Total", field:"sum"},
                {title:"Game", field:"game"},
            ],
        });
    </script>
@endsection
