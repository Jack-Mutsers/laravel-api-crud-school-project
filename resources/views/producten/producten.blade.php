@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col">
            <div class="row justify-content-center">
                <div class="col-md-3">
                    <select name="filter" id="filter" class="form-control"> 
                        <option value="InStock">InStock</option> 
                        <option value="Ordered">Ordered</option> 
                        <option value="Discontinued">Discontinued</option> 
                    </select>
                </div>
                <div class="col-md-3">
                    <select name="status" id="status" class="form-control"> 
                        <option value="true">true</option> 
                        <option value="false">false</option> 
                    </select>
                </div>
                <div class="col-md-1">
                    <button id="btnfilter" class="btn btn-default btn-md">filter</button> 
                </div>
                <div class="col-md-1">
                    <button id="btnclearfilter" class="btn btn-default btn-md" onclick="clearfilter()">clear filter</button>
                </div>
            </div>
            <div class="row justify-content-center">
                <table class="producten">
                    <thead class="producten">
                        <tr>
                            <th class="vak1">Productnaam</th>
                            <th class="vak2">InStock</th>
                            <th class="vak2">Ordered</th>
                            <th class="vak2">Discontinued</th>
                            <th class="vak2">delete</th>
                        </tr>
                    </thead>
                    <tbody id="tableBody" class="producten">
                    </tbody>
                </table>
            </div>
            <div class="row justify-content-center">
                <a href="newProduct">nieuw product toevoegen</a>
            </div>
        </div>
    </div>
</div>

<script>
        var Filter = null;
        var Status = null;

    $(function() {
        $("#btnfilter").on('click', function() {
            Filter = $("#filter option:selected").val();
            Status = $("#status option:selected").val();
            getproducts();
        });
    });

        function removeRow(id){
            //alert(id);
            $.ajax({
                url: '/api/products/' + id,
                type: "delete",
                data: {},
                success: function(response){ // What to do if we succeed
                    alert(response);
                    getproducts();
                },
                error: function(data){
                    console.log('Error:', data);
                }
            });
        }

        function getproducts(){
            var products = null;
            $("#tableBody").empty();
            
            $.ajax({
                url: '/api/products',
                type: "get",
                data: {
                    filter: Filter,
                    status: Status
                    },
                success: function(response){ // What to do if we succeed
                    var products;
                    if(Filter == null){
                        products = response[0];
                    }else{
                        products = response;
                    }
                    
                    alert(products.length);
                    for (let i = 0; i < products.length; i++) {
                        var item = products[i];
                        
                        $('<tr></tr>')
                        .append('<td class="vak1"><form method="post" action="Product">@csrf<input type="hidden" id="productname" name="productname" value="' + item['ProductID'] + '"><button class="link">' + item['ProductName'] + '</button></from></td>')
                        .append('<td class="vak2">' + item['UnitsInStock'] + '</td>')
                        .append('<td class="vak2">' + (item['UnitsOnOrder'] > 0 ? "yes" : "no") + '</td>')
                        .append('<td class="vak2">' + (item['Discontinued'] == "y" ? "yes" : "no") + '</td>')
                        .append('<td class="vak2"><a class="remove btn btn-default btn-md" id="remove' + item['ProductID'] + '" role="button" onclick="removeRow(' + item['ProductID'] + ')">X</a></td>')
                        .appendTo($('#tableBody'));
                    }
                },
                error: function(data){
                    console.log('Error:', data);
                }
            });
        }
        getproducts();
    //});
</script>
@endsection

<!--send post by jquery on <a href> klik-->