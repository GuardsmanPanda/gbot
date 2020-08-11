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
                {column:"Length", dir:"desc"},
                {column:"Total", dir:"desc"}
            ],
            layout:"fitData",
            columns:[
                {title:"Twitch Name", field:"name", headerSort:false},
                {title:"Length", field:"length", sorter:"number", formatter:"progress", formatterParams:{
                        min:0,
                        max:{{$p_max->ml}},
                        color:"burlywood",
                        legend:true,
                        legendColor:"#000000",
                        legendAlign:"center",
                    }},
                {title:"Total", field:"sum", sorter:"number", formatter:"progress", formatterParams:{
                        min:0,
                        max:{{$p_max->ms}},
                        color:"burlywood",
                        legend:true,
                        legendColor:"#000000",
                        legendAlign:"center",
                    }},
                {title:"Game", field:"game"},
                {title:"Played At", field:"created_at", formatter:"datetime"}
            ],
        });
    </script>
@endsection
