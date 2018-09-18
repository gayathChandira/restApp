@extends('inventoryMgr')

@section('content')
    <h1>Update Stock</h1>
    
    {!! Form::open(['action'=> 'FoodItemController@store', 'method' =>'POST', 'autocomplete' =>'off'])!!}
        <div class="form-group">
            {{Form::label('foodItem_id', 'Item code')}}
            {{Form::text('foodItem_id', '', ['class' =>'form-control', 'placeholder'=>'Food Item ID', 'id'=>'item_ID'])}}
            {{-- <input type="text" class="form-control" id="item_ID"> --}}
            <div id="item_list" style="z-index: 1;position:absolute;"></div>            
        </div> 
              
        <div class="form-group">
            {{Form::label('foodItem', 'Food Item')}}
            {{Form::text('foodItem', '', ['class' =>'form-control', 'id'=>'item_name','placeholder'=>'Food Item Name'])}}
            <div id="name_list" style="z-index: 1;position:absolute;"></div>   
        </div> 
                  
        {{ csrf_field() }}  
        <div class="form-group">
                {{Form::label('quantity', 'Quantity')}}
                {{Form::text('quantity', '', ['class' =>'form-control', 'placeholder'=>'Quantity'])}}
        </div>

        <div class="form-group">
            {{Form::label('unitPrice', 'Unit Price')}}
            {{Form::text('unitPrice', '', ['class' =>'form-control', 'placeholder'=>'Unit Price'])}}
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
                        url:"{{ route('FoodItemController.fetch')}}",    
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){                            
                            $('#item_list').fadeIn();
                            $('#item_list').html(data);
                        }           
                     })
                }
            });
            //Get the food Item name when use clicks the item code
            $(document).on('click', '#list1', function(){                
                $('#item_ID').val($(this).text());
                $('#item_list').fadeOut();  
                var query =$(this).text(); 
                if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('FoodItemController.fetchItemName')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            $('#item_name').val(data);
                        }        
                     })
                     
                }
            });
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
            //get item-id when user selcts the item name from the dropdown list
            if($('#item_name').keyup()){ 
                $(document).on('click', '#list2', function(){                
                $('#item_name').val($(this).text());
                $('#name_list').fadeOut();  
                var query =$(this).text(); 
                if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('FoodItemController.fetchID')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            $('#item_ID').val(data);
                        }        
                     })
                     
                }    
            });
            }
           
        });

    </script>
@endsection