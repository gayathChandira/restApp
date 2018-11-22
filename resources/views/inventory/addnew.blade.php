@extends('inventoryMgr')

@section('content')
<div class="form-row">
    <div class="card col-md-5  form-group">
        <div class="card-body">
                <h1>Add New Food Item</h1>
                {!! Form::open(['action'=> 'FoodItemController@storenew', 'method' =>'POST'])!!}
                    <div class="form-group mt-5">
                        {{Form::label('foodItem', 'Food Item Name')}}
                        {{Form::text('foodItem', '', ['class' =>'form-control', 'placeholder'=>'Food Item Name'])}}
                    </div>   
                    
                    <div class="form-group">
                            {{Form::label('unit', 'Unit')}}
                            {{Form::text('unit', '', ['class' =>'form-control', 'placeholder'=>'Unit Name'])}}
                    </div>    
                    <div class="form-group">
                            {{Form::label('limit', 'Food-Item Limit')}}
                            {{Form::text('limit', '', ['class' =>'form-control', 'placeholder'=>'Food Item Limit'])}}
                    </div> 
                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
                {!! Form::close() !!}
        </div>
    </div>
    <div class="col-md-1 ml-5 mr-4 form-group">
        
    </div>    
    <div class="card col-md-5 form-group">
        <div class="card-body">
                <h1>Edit Food Item Details</h1>
                {!! Form::open(['action'=> 'FoodItemController@editSubmit', 'method' =>'POST'])!!}
                    <div class="form-group mt-5">
                        {{Form::label('foodItem', 'Food Item Name')}}
                        {{Form::text('foodItem', '', ['class' =>'form-control','id'=>'item_name', 'placeholder'=>'Food Item Name'])}}
                        <div id="item_list" style="z-index: 1;position:absolute;"></div> 
                    </div>   
                    
                    <div class="form-group">
                            {{Form::label('unit', 'Unit')}}
                            {{Form::text('unit', '', ['class' =>'form-control','id'=>'unit2' ,'placeholder'=>'Unit Name'])}}
                    </div>    
                    <div class="form-group">
                            {{Form::label('limit', 'Food-Item Limit')}}
                            {{Form::text('limit', '', ['class' =>'form-control','id'=>'limit2', 'placeholder'=>'Food Item Limit'])}}
                    </div> 
                    {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
                {!! Form::close() !!}
        </div>

    </div>
</div>


<script>

    //Get item name when use type the item-name in text box
    $('#item_name').keyup(function(){
        var query = $(this).val();                            
        if(query != ''){                    
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('FoodItemController.fetchNameWhenType')}}",    
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){                            
                    $('#item_list').fadeIn();
                    $('#item_list').html(data);
                }           
            })
        }
    });
    //set item-id when user selcts the item name from the dropdown list
    if($('#item_name').keyup()){ 
        $(document).on('click', '#list2', function(){                
            $('#item_name').val($(this).text());
            $('#item_list').fadeOut();  
            var query =$(this).text(); 
            if(query != ''){                                    
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('FoodItemController.editItem')}}",   
                    method:"POST",
                    data:{query:query,_token:_token},                        
                    success:function(data){  
                        $('#unit2').val(data.unit);
                        $('#limit2').val(data.limit);                   
                    }        
                })
                    
            }    
        });
    }
</script>    
    
@endsection