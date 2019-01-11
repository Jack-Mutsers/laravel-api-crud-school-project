@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table>
            <thead>
                <tr>
                    <th class="vak1">Productnaam</th>
                    <th class="vak2">InStock</th>
                    <th class="vak2">Ordered</th>
                    <th class="vak2">Discontinued</th>
                </tr>
            </thead>
            <tbody id="tableBody">
            </tbody>
        </table>
    </div>
</div>

<script>
    $(function() {
        $.ajax({
            url: '/api/products',
            type: "get",
            data: {},
            success: function(response){ // What to do if we succeed
                var script = response[0];
                //alert(script[0]['ProductName']);
                for (let i = 0; i < script.length; i++) {
                    var item = script[i];
                    
                    $('<tr></tr>')
                    .append('<td class="vak1"><a href="">' + item['ProductName'] + '</a></td>')
                    .append('<td class="vak2">' + item['UnitsInStock'] + '</td>')
                    .append('<td class="vak2">' + (item['UnitsOnOrder'] > 0 ? "yes" : "no") + '</td>')
                    .append('<td class="vak2">' + (item['Discontinued'] == "y" ? "yes" : "no") + '</td>')
                    .appendTo($('#tableBody'));
                }
            },
            error: function(data){
                console.log('Error:', data);
            }
        });
    });
</script>
@endsection