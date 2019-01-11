@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table>
            <tbody id="tableBody">
            </tbody>
        </table>
        <button class="hidden form-control" id="change" hidden data-token="{{ csrf_token() }}">add</button>
        <button class="form-control" onclick="enablechange()">Enable Change</button>
    </div>
</div>

<script>
    sellected = <?php echo json_encode($name); ?>;
    
    function enablechange(){
        $(".hidden").removeAttr('hidden');
        $(".vak3").removeAttr('readonly');
        $(".vak3").removeAttr('disabled');
    }

    $(function() {
        
        $.ajax({
            url: "/api/products/" + sellected,
            type: "get",
            success: function(response){ // What to do if we succeed
                for (let i = 0; i < response.length; i++) {
                    var item = response[i];
                    
                    $('<tr></tr>')
                    .append('<input id="id" type="hidden" name="id" value="' + item['ProductID'] + '">')
                    .append('<th class="vak1">Productnaam</th>')
                    .append('<td><input id="name" type="text" class="vak3 form-control inputfield" name="name" value="' + item['ProductName'] + '" required readonly></td>')
                    .appendTo($('#tableBody'));
                    
                    $('<tr></tr>')
                    .append('<th class="vak1">SupplierID</th>')
                    .append('<td><select name="suplierid" id="suplierid" class="vak3 form-control" disabled> @if(count($suppliers)>0) @foreach ($suppliers as $supplier) <option value="{{{$supplier["SupplierID"]}}}">{{{$supplier["CompanyName"]}}}</option> @endforeach @endif </select></td>')
                    .appendTo($('#tableBody'));
                    $("#suplierid").val(item['SupplierID']);

                    $('<tr></tr>')
                    .append('<th class="vak1">CatagoryID</th>')
                    .append('<td><select name="categoryid" id="categoryid" class="vak3 form-control" disabled> @if(count($categories)>0) @foreach ($categories as $category) <option value="{{{$category["CategoryID"]}}}">{{{$category["CategoryName"]}}}</option> @endforeach @endif </select></td>')
                    .appendTo($('#tableBody'));
                    $("#categoryid").val(item['CategoryID']);
                    
                    $('<tr></tr>')
                    .append('<th class="vak1">QuantityPerUnit</th>')
                    .append('<td><input id="quantityperunit" type="text" class="vak3 form-control inputfield" name="quantityperunit" value="' + item['QuantityPerUnit'] + '" required readonly></td>')
                    .appendTo($('#tableBody'));
                    
                    $('<tr></tr>')
                    .append('<th class="vak1">UnitPrice</th>')
                    .append('<td><input id="unitprice" type="text" class="vak3 form-control inputfield" name="unitprice" value="' + item['UnitPrice'] + '" required readonly></td>')
                    .appendTo($('#tableBody'));
                    
                    $('<tr></tr>')
                    .append('<th class="vak1">UnitsInStock</th>')
                    .append('<td><input id="unitsinstock" type="text" class="vak3 form-control inputfield" name="unitsinstock" value="' + item['UnitsInStock'] + '" required readonly></td>')
                    .appendTo($('#tableBody'));
                    
                    $('<tr></tr>')
                    .append('<th class="vak1">UnitsOnOrder</th>')
                    .append('<td><input id="unitsonorder" type="text" class="vak3 form-control inputfield" name="unitsonorder" value="' + item['UnitsOnOrder'] + '" required readonly></td>')
                    .appendTo($('#tableBody'));
                    
                    $('<tr></tr>')
                    .append('<th class="vak1">ReorderLevel</th>')
                    .append('<td><input id="reorderlevel" type="text" class="vak3 form-control inputfield" name="reorderlevel" value="' + item['ReorderLevel'] + '" required readonly></td>')
                    .appendTo($('#tableBody'));
                    
                    $('<tr></tr>')
                    .append('<th class="vak1">Discontinued</th>')
                    .append('<td><input id="discontinued" type="text" class="vak3 form-control inputfield" name="discontinued" value="' + item['Discontinued'] + '" required readonly></td>')
                    .appendTo($('#tableBody'));
                }
            },
            error: function(data){
                console.log('Error:', data);
            }
        });
        
        $( "#change" ).on('click', function() {
            if(validateForm()){
                $.ajax({
                    url: "/api/products/"+ $("#id").val(),
                    type: 'POST',
                    data: { _method: "PUT",
                        _token: $(this).data('token'),
                        id: $("#id").val(),
                        name: $("#name").val(),
                        suplierid: $("#suplierid").val(),
                        categoryid: $("#categoryid").val(),
                        quantityperunit: $("#quantityperunit").val(),
                        unitprice: $("#unitprice").val(),
                        unitsinstock: $("#unitsinstock").val(),
                        unitsonorder: $("#unitsonorder").val(),
                        reorderlevel: $("#reorderlevel").val(),
                        discontinued: $("#discontinued").val()},
                    success: function(response){ // What to do if we succeed
                        alert(response);
                    },
                    error: function(data){
                        console.log('Error:', data);
                    }
                });
            } else { alert('vul alle vakken in') }
        });

        function validateForm() {
            var isValid = true;
            $('.vak3').each(function() {
                if ( $(this).val() === '' )
                    isValid = false;
            });
            return isValid;
        }
    });
</script>
@endsection