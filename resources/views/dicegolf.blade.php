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
            initialSort: [
                {column:"length", dir:"desc"},
                {column:"sum", dir:"desc"}
            ],
            layout:"fitColumns",
            columns:[
                {title:"Twitch Name", field:"name"},
                {title:"Length", field:"length", formatter:"progress", width:200},
                {title:"Total", field:"sum"},
                {title:"Game", field:"game"},
            ],
        });
    </script>
@endsection
