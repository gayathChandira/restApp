@extends('inventoryMgr')

@section('content')
    <h1>Update Stock</h1>
    {!! Form::open(['action'=> 'FoodItemController@store', 'method' =>'POST'])!!}
        <div class="form-group">
            {{Form::label('foodItem_id', 'Item code')}}
            {{-- {{Form::text('foodItem_id', '', ['class' =>'form-control', 'placeholder'=>'Food Item ID', 'id'=>'item_ID'])}} --}}
            <input type="text" class="form-control" id="item_ID">
            <div id="item_list" style="z-index: 2;"></div>
        </div> 
        {{ csrf_field() }}
        
        <div class="form-group">
            {{Form::label('foodItem', 'Food Item')}}
            {{Form::text('foodItem', '', ['class' =>'form-control', 'placeholder'=>'Food Item'])}}
        </div>   
        <div class="form-group">
                {{Form::label('quantity', 'Quantity')}}
                {{Form::text('quantity', '', ['class' =>'form-control', 'placeholder'=>'Quantity'])}}
        </div>
        <div class="form-group">
                {{Form::label('vendor', 'Vendor Name')}}
                {{Form::text('vendor', '', ['class' =>'form-control', 'placeholder'=>'Vendor Name'])}}
        </div>    

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
    {!! Form::close() !!}

    
    <script>  
        //Load up item_id from the data base when user type in text box
        $(document).ready(function(){            
            $('#item_ID').keyup(function(){
                var query = $(this).val();      
                         
                if(query != ''){                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('FoodItemController.fetch')}}",    //check here
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){                            
                            $('#item_list').fadeIn();
                            $('#item_list').html(data);
                        }           
                     })
                }
            });
            $(document).on('click', 'li', function(){
                $('#item_ID').val($(this).text());
                $('#item_list').fadeOut();
            });
        });
    </script>
@endsection