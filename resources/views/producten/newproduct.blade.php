@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <table>
            <thead>
                <tr>
                </tr>
            </thead>
            <tbody id="tableBody">
                <tr>
                    <th class="vak1">Productnaam</th>
                    <td><input id="name" type="text" class="vak3 form-control inputfield" name="name" required></td>
                </tr><tr>
                    <th class="vak1">SupplierID</th>
                    <td>
                        <select name="suplierid" id="suplierid" class="vak3 form-control"> 
                            @if(count($suppliers)>0) 
                                @foreach ($suppliers as $item) 
                                    <option value="{{{$item["SupplierID"]}}}">{{{$item["CompanyName"]}}}</option> 
                                @endforeach 
                            @endif
                        </select>
                    </td>
                </tr><tr>
                    <th class="vak1">CatagoryID</th>
                    <td><select name="categoryid" id="categoryid" class="vak3 form-control"> 
                            @if(count($categories)>0) 
                                @foreach ($categories as $item) 
                                    <option value="{{{$item["CategoryID"]}}}">{{{$item["CategoryName"]}}}</option> 
                                @endforeach 
                            @endif 
                        </select>
                    </td>
                </tr><tr>
                    <th class="vak1">QuantityPerUnit</th>
                    <td><input id="quantityperunit" type="text" class="vak3 form-control inputfield" name="quantityperunit" required></td>
                </tr><tr>
                    <th class="vak1">UnitPrice</th>
                    <td><input id="unitprice" type="text" class="vak3 form-control inputfield" name="unitprice" required></td>
                </tr><tr>
                    <th class="vak1">UnitsInStock</th>
                    <td><input id="unitsinstock" type="text" class="vak3 form-control inputfield" name="unitsinstock" required></td>
                </tr><tr>
                    <th class="vak1">ReorderLevel</th>
                    <td><input id="unitsonorder" type="text" class="vak3 form-control inputfield" name="unitsonorder" required></td>
                </tr><tr>
                    <th class="vak1">UnitsOnOrder</th>
                    <td><input id="reorderlevel" type="text" class="vak3 form-control inputfield" name="reorderlevel" required></td>
                </tr><tr>
                    <th class="vak1">Discontinued</th>
                    <td><input id="discontinued" type="text" class="vak3 form-control inputfield" name="discontinued" required></td>
                </tr>
            </tbody>
        </table>
        <button class="hidden form-control" id="add" data-token="{{ csrf_token() }}">add</button>
    </div>
</div>

<script>
    $(function() {        
        $( "#add" ).on('click', function() {
            if(validateForm()){
                $.ajax({
                    url: "/api/products/",
                    type: 'POST',
                    data: {
                        _token: $(this).data('token'),
                        name: $("#name").val(),
                        suplierid: $("#suplierid option:selected").val(),
                        categoryid: $("#categoryid option:selected").val(),
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
            } else { alert('error') }
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