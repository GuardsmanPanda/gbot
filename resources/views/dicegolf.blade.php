@extends('layouts.layout')

@section('content')
    <div class="ribbon-content">
        <h1 class="ribbon-title">DiceGolf Stats</h1>
        <h5 class="mt-2">Sort By Most Throws or Highest Sum!</h5>
        <div id="dg-stats"></div>
    </div>

    <div class="ribbon-content">
        <h1 class="ribbon-title">DiceGolf Information</h1>
        <h5 class="mt-2">To Play Type !dg Number in Twitch Chat!</h5>
        <div class="container">
            <div class="row">
                <div id="dg-hole-in-one">
                </div>
                <div id="dg-most-games">
                </div>
                <div id="dg-most-popular">
                </div>
            </div>
        </div>
    </div>


    <script>
        const flag_icon_mutator = function(value, data, type, params, component) {
            return '/static/img/flags/' + value + ".png";
        }
        const table = new Tabulator("#dg-stats", {
            ajaxURL: "/dicegolf/stats?start={{$start}}",
            ajaxSorting: true,
            maxHeight: "75vh",
            initialSort: [
                {column:"length", dir:"desc"},
            ],
            layout: "fitData",
            columns:[
                {title:"Rank", field:"rank", formatter:"rownum", headerSort:false},
                {title: "Flag", field:"flag", mutator: flag_icon_mutator, headerSort: false,
                    formatter: "image", formatterParams: {
                        height:"26px",
                    }},
                {title:"Twitch Name", field:"name", headerSort:false},
                {title:"Length", field:"length", width:260, headerSortStartingDir:"desc",
                    formatter:"progress", formatterParams:{
                        min:0,
                        max:{{$p_max->ml}},
                        color:"lightGreen",
                        legend:true,
                        legendColor:"#000000",
                        legendAlign:"center",
                    }},
                {title:"Total", field:"sum", width:260, headerSortStartingDir:"desc",
                    formatter:"progress", formatterParams: {
                        min:0,
                        max:{{$p_max->ms}},
                        color:"lightGreen",
                        legend:true,
                        legendColor:"#000000",
                        legendAlign:"center",
                    }},
                {title:"Game", field:"game", headerSort:false},
                {title:"Played At", width:128, field:"created_at", mutator:tabulatorUTCToLocal,
                    formatter:"datetimediff", formatterParams: {
                        humanize:true,
                        suffix: true
                    }
                }
            ],
        });
    </script>

    <script>
        const dg1 = new Tabulator("#dg-hole-in-one", {
            ajaxURL: "/dicegolf/hole-in-one",
            autoColumns:true,
        });

        const dg2 = new Tabulator("#dg-most-games", {
            ajaxURL: "/dicegolf/most-games",
            autoColumns:true,
        });

        const dg3 = new Tabulator("#dg-most-popular", {
            ajaxURL: "/dicegolf/most-popular",
            autoColumns:true,
        });
    </script>
@endsection
