@extends('layouts.layout')

@section('content')
    <div class="ribbon-content">
        <h1 class="ribbon-title">Twitch Chat Stats</h1>
        <h5 class="mt-2">Where did it all go wrong.</h5>
        <div id="chat-stats"></div>
    </div>


    <script>
        const table = new Tabulator("#chat-stats", {
            ajaxURL: "/twitch-chat-stats/stats",
            ajaxSorting: true,
            maxHeight: "75vh",
            autoColumns:true,
            autoColumnsDefinitions: [
                {title:"Twitch Name", field:"name", headerSort:false},
            ]
        });
    </script>
@endsection
