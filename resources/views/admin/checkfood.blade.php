@extends('admin')

@section('content')

<div class="card mb-4 wow fadeIn ">      
    <div class="card-body">
        <h2 class="mt-4">Check the Vendors for Food Items</h2> 
        <div class="form-group mt-5">
            <label for="users" class="mr-3 ml-3">Select Food Item</label>
            <select name="user_id" id="items" class="form-control" >
                @foreach($fooditem as $key)
                <option value="{{ $key->itemName }}">{{ $key->itemName }}</option>
                @endforeach
            </select>
        </div>


        <button type="button" onclick="makeTable()" class="btn btn-primary mt-5 ">Next</button>

        <div id="table"></div>
    </div>
</div>



<script>
        $(document).ready(function(){
            $('#items').select2({
                placeholder : 'Please Select Item ',               
                width: '18%'
            });
        });

        function makeTable(){
        var values = $('#items').val();           
        var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('CheckVendorController.check')}}",   
                method:"POST",
                data:{values:values,_token:_token},                        
                success:function(data){                     
                    $('#table').html(data);                                   
                }        
        })
    }

</script>        
@endsection