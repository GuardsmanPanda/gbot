@extends('layouts.layout')

@section('content')
    <div class="ribbon-content">
        <h1 class="ribbon">DiceGolf-v3 Stats</h1>
        <h5 class="mt-2">Sort By Most Throws or Highest Sum!</h5>
        <div id="dg-stats"></div>
    </div>


    <script>
        const table = new Tabulator("#dg-stats", {
            ajaxURL: "/dicegolf/stats",
            ajaxFiltering: true,
            initialHeaderFilter:[
                {field:"game", value:"100"}
            ],
            ajaxSorting: true,
            initialSort: [
                {column:"length", dir:"desc"},
            ],
            ajaxResponse:function(url, params, response){
                let maxLen = 1, maxSum = 1;
                response.forEach(row => {
                    maxLen = Math.max(maxLen, row.length);
                    maxSum = Math.max(maxSum, row.sum);
                });
                console.log(maxLen);
                console.log(maxSum);
                let col = table.getColumn('length');
                col.updateDefinition({title:"Length", field:"length", width:210, sorter:"number", headerSortStartingDir:"desc",
                    formatter:"progress", formatterParams:{
                        min:0,
                        max:maxLen,
                        color:"lightGreen",
                        legend:true,
                        legendColor:"#000000",
                        legendAlign:"center",
                    }
                });
              //  table.updateColumnDefinition("length", {title:"Length", field:"length", formatterParams: {max: maxLen}});
                return response; //return the response data to tabulator
            },
            height: "75vh",
            layout: "fitData",
            columns:[
                {title:"Stats, Click To Sort By Length or Sum",
                    columns: [
                        {title:"Rank", field:"rank", formatter:"rownum", headerSort:false},
                        {title:"Twitch Name", field:"name", headerSort:false},
                        {title:"Length", field:"length", width:210, sorter:"number", headerSortStartingDir:"desc",
                            formatter:"progress", formatterParams:{
                                min:0,
                                max:{{$p_max->ml}},
                                color:"lightGreen",
                                legend:true,
                                legendColor:"#000000",
                                legendAlign:"center",
                            }
                        },
                        {title:"Total", field:"sum", width:210, sorter:"number", headerSortStartingDir:"desc",
                            formatter:"progress", formatterParams:{
                                min:0,
                                max:{{$p_max->ms}},
                                color:"lightGreen",
                                legend:true,
                                legendColor:"#000000",
                                legendAlign:"center",
                            }
                        },
                    ]
                },
                {title:"Game", field:"game", headerSort:false, headerFilter:"number"},
                {title:"Played At", field:"created_at", formatter:"datetimediff", formatterParams: {
                    humanize:true,
                    suffix: true
                }}
            ],
        });
    </script>
@endsection
