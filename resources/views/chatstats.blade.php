@extends('layouts.layout')

@section('content')
    <div class="ribbon-content">
        <h1 class="ribbon-title">Twitch Chat Stats</h1>
        <h5 class="mt-2">Where did it all go wrong.</h5>
        <div id="chat-stats"></div>
    </div>


    <script>
        const flag_icon_mutator = function(value, data, type, params, component) {
            return '/static/img/flags/' + value + ".png";
        }
        const table = new Tabulator("#chat-stats", {
            ajaxURL: "/twitch-chat-stats/stats",
            ajaxSorting: true,
            maxHeight: "75vh",
            columns: [
                {title:"Rank", field:"rank", formatter:"rownum", headerSort:false},
                {title: "Flag", field:"flag", mutator: flag_icon_mutator, formatter: "image"},
                {title:"Twitch Name", field:"name", headerSort:false},
                {title:"Chat Lines", field:"chat_lines", width:240, headerSortStartingDir:"desc",
                    formatter:"progress", formatterParams:{
                        min:0,
                        max:{{$max_vals->chat_lines}},
                        color:"lightGreen",
                        legend:true,
                        legendColor:"#000000",
                        legendAlign:"center",
                    }
                },
                {title:"Active Hours", field:"active_hours", width:240, headerSortStartingDir:"desc",
                    formatter:"progress", formatterParams:{
                        min:0,
                        max:{{$max_vals->active_hours}},
                        color:"lightGreen",
                        legend:true,
                        legendColor:"#000000",
                        legendAlign:"center",
                    }
                },
                {title:"Idle Hours", field:"idle_hours", width:240, headerSortStartingDir:"desc",
                    formatter:"progress", formatterParams:{
                        min:0,
                        max:{{$max_vals->idle_hours}},
                        color:"lightGreen",
                        legend:true,
                        legendColor:"#000000",
                        legendAlign:"center",
                    }
                },
                {title:"Bob Coins", field:"bob_coins", width:240, headerSortStartingDir:"desc",
                    formatter:"progress", formatterParams:{
                        min:0,
                        max:{{$max_vals->bob_coins}},
                        color:"lightGreen",
                        legend:true,
                        legendColor:"#000000",
                        legendAlign:"center",
                    }
                },
                {title:"Last Seen", width:128, field:"updated_at", mutator:tabulatorUTCToLocal,
                    formatter:"datetimediff", formatterParams: {
                        humanize:true,
                        suffix: true
                    }
                },
            ]
        });
    </script>
@endsection
