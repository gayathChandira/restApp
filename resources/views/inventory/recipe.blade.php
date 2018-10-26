@extends('inventoryMgr')

@section('content')
    <h1 class="card-title">Make a New Recipe</h1>
    {!! Form::open(['action'=>'RecipeController@store', 'method' =>'POST','autocomplete' =>'off'])!!}
        <div class="form-group">
            {{Form::label('recipeName', 'Meal Name')}}
            {{Form::text('recipeName', '', ['class' =>'form-control', 'placeholder'=>'Recipe', 'id'=>'item_ID'])}}
            <!-- {{-- <input type="text" class="form-control" id="item_ID"> --}} -->
            <div id="item_list" style="z-index: 1;position:absolute;"></div>            
        </div>
        {{ csrf_field() }}  
        <div id="room_fileds">
            <div class="form-row">
                <div class="col-sm-4 form-group"  >
                    {{Form::label('ingredients', 'Ingredients')}}
                    {{Form::text('ingri[0]', '', ['class' =>'form-control item_name0', 'placeholder'=>'Item', 'id'=>'ingri'])}}
                    <div id="name_list0" style="z-index: 1;position:absolute;"></div>     
                                        
                </div> 
                <div class="col-sm-4 form-group ">
                    {{Form::label('amounts', 'Amounts')}}
                    {{Form::text('amount[0]', '', ['class' =>'form-control', 'placeholder'=>'Amounts', 'id'=>'amount'])}}
                </div> 
                <input type="button" class="btn btn-primary" id="more_fields" onclick="add_fields();" value="Add More" />
                <div class="col-sm-4 card mb-4" >
                    <div class="card-body" id="thelist">
                        {{-- popup parts --}}
                    </div>
                    
                </div>
            </div>  
        </div>   
        <br><br><br>   
              
         <br><br><br><br><br>
         <input type="hidden" name="loopLength" id="length"/>
        <div style="display:block;">
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
        </div>
        
    {!! Form::close() !!}
    {{-- <div class="col form-group">
        <a type="button" id="clickR[0]" class="btn-floating cyan"><i class="fa fa-check" aria-hidden="true"></i></a>
        <a type="button" id="clickX[0]" class="btn-floating cyan"><i class="fa fa-close" aria-hidden="true"></i></a>
    </div> --}}
    <script>
       var room =0 ; 

        $('#room_fileds').on('keyup','.item_name0',function(){      
            var query = $(this).val(); 
                                   
            if(query != ''){                    
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('FoodItemController.fetchNameWhenType')}}",    
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){                            
                        $('#name_list0').fadeIn();
                        $('#name_list0').html(data);
                    }           
                    })
            }
        });           
        //set item-id when user selcts the item name from the dropdown list
        
        $(document).on('click', '#list2', function(){                      
            $('.item_name0').val($(this).text());
            $('#name_list0').fadeOut();  
        });
      
        function add_fields() {           
            room++;            
            var objTo = document.getElementById('thelist');
            var divtest = document.createElement("div");
            divtest.innerHTML = '<form><div class="form-row">\
            <div class="form-group col"><label>'+document.getElementById('ingri').value+'</label></div>\
            <div class="form-group col"><label>'+document.getElementById('amount').value+'</label>\
            <a href="#" onclick="storing(\''+document.getElementById('item_ID').value+'\',\''+document.getElementById('ingri').value+'\',\''+document.getElementById('amount').value+'\')" id="clickX['+room+']" class="btn-floating cyan"><i class="fa fa-close" aria-hidden="true"></i></a></div>\
            </div></form>  {{ csrf_field() }}  ';
            objTo.appendChild(divtest);
            document.getElementById('length').value = room+1;
            var hello = document.getElementById("length").value
            
        }
        function storing(dname, ingri, amount) {
            $.ajax({
                url: "{{route('RecipeController.store1')}}",
                type: 'POST',
                data: { 
                    dname: dname,
                    ingri: ingri,
                    amount: amount                    
                },
                dataType: 'json',
                success: function() { alert('hello!'); },
                error: function() { alert('boo!'); },
                headers: {
                    'X-CSRF-Token': $('meta[name="csrf-token"]').attr('content')
                }
            });
        }
        
       
    </script>
    
@endsection