@extends('layouts.layout')

@section('content')
    <div id="dg-stats"></div>



    <script>
        var table = new Tabulator("#dg-stats", {
            ajaxURL: "/dicegolf/stats",
            layout:"fitColumns",
            columns:[
                {title:"ID", field:"id"},
            ],
            rowClick:function(e, row){ //trigger an alert message when the row is clicked
                alert("Row " + row.getData().id + " Clicked!!!!");
            },
        });
    </script>
@endsection
