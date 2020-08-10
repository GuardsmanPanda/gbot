@extends('layouts.layout')

@section('content')
    <div class="ribbon-content">
        <h1 class="ribbon">DiceGolf-v2 Stats</h1>
        <h5 class="mt-2">Sort By Most Throws or Highest Sum!</h5>
        <div id="dg-stats"></div>
    </div>




    <script>
        const table = new Tabulator("#dg-stats", {
            ajaxURL: "/dicegolf/stats",
            layout:"fitColumns",
            columns:[
                {title:"ID", field:"id"},
                {title:"Twitch Name", field:"name"},
                {title:"Length", field:"length"},
                {title:"Total", field:"sum"},
                {title:"Game", field:"game"},
            ],
        });
    </script>
@endsection
