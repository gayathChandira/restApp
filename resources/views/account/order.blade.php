@extends('accountant')
@section('content')
<div class="card-body">
    <h2>Order Food Items</h2>    
    
        {!! Form::open(['action'=> 'FoodItemController@storenew', 'method' =>'POST','autocomplete' =>'off'])!!}
        
            <div class="form-group mt-5">
                
                {{Form::label('foodItem', 'Food Item Name')}}
                {{Form::text('foodItem', !empty($foodname) ? $foodname : '', ['class' =>'form-control','id'=>'item_name', 'placeholder'=>'Food Item Name'])}}
                <div id="name_list" style="z-index: 1;position:absolute;"></div>  
            </div>   
            
            <div class="form-group">
                    {{Form::label('unit', 'Unit')}}
                    {{Form::text('unit', '', ['class' =>'form-control','id'=>'unit', 'placeholder'=>'Unit Name'])}}
            </div>    
            {{ csrf_field() }} 
            <div class="form-group">
                    {{Form::label('quantity', 'Quantity')}}
                    {{Form::text('quantity', '', ['class' =>'form-control', 'placeholder'=>'Requesting Quantity'])}}
            </div> 
        
            <div class="form-group">
                {{Form::label('vendor', 'Vendor')}}
                {{Form::text('vendor', '', ['class' =>'form-control','id'=>'vendorName', 'placeholder'=>'Vendor'])}}
                <div id="item_list" style="z-index: 1;position:absolute;"></div> 
            </div> 
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
        {!! Form::close() !!}
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
                    $('#name_list').fadeIn();
                    $('#name_list').html(data);
                }           
                })
        }
    });

    //set item-id when user selcts the item name from the dropdown list
    if($('#item_name').keyup()){ 
        $(document).on('click', '#list2', function(){                
            $('#item_name').val($(this).text());
            $('#name_list').fadeOut();  
            var query =$(this).text(); 
            if(query != ''){                                    
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('OrderController.fetchUnit')}}",   
                    method:"POST",
                    data:{query:query,_token:_token},                        
                    success:function(data){   
                        $('#unit').val(data);
                    }        
                    })
                    
            }
            $('#vendorName').keyup(function(){
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('OrderController.vendorLoad')}}",   
                    method:"POST",
                    data:{query:query,_token:_token},                        
                    success:function(data){   
                        $('#item_list').fadeIn();
                        $('#item_list').html(data);
                    }        
                })  
                $(document).on('click', '#list3', function(){                
                $('#vendorName').val($(this).text());
                $('#item_list').fadeOut(); 
            
                });
            });
        });
    }
           

</script>
@endsection
