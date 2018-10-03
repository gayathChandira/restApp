@extends('inventoryMgr')

@section('content')
    <h1>Make a New Recipe</h1>
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
                <div class="col form-group"  >
                    {{Form::label('ingredients', 'Ingredients')}}
                    {{Form::text('ingri[0]', '', ['class' =>'form-control item_name', 'placeholder'=>'Item'])}}
                    <div id="name_list" style="z-index: 1;position:absolute;"></div>                     
                </div> 
                <div class="col form-group ">
                    {{Form::label('amounts', 'Amounts')}}
                    {{Form::text('amount[0]', '', ['class' =>'form-control', 'placeholder'=>'Amounts'])}}
                </div> 
            </div>  
        </div>      
        <input type="button" class="btn btn-primary" id="more_fields" onclick="add_fields();" value="Add More" />          
         <br><br><br><br><br>
         <input type="hidden" name="loopLength" id="length"/>
        <div style="display:block;">
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
        </div>
        
    {!! Form::close() !!}
     
    <script>
        
        $(document).ready(function(){
            //Get ingridient name when use type the name in text box
            $('.item_name').keyup(function(){
                var query = $(this).val(); 
                console.log(query);                           
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
            if($('.item_name').keyup()){ 
                $(document).on('click', '#list2', function(){                
                $('#item_name').val($(this).text());
                $('#name_list').fadeOut();  

                });
            }

        });
        var room = 0;      
        function add_fields() {
            room++;
            var objTo = document.getElementById('room_fileds')
            var divtest = document.createElement("div");
            divtest.innerHTML = '<div class="form-row"><div class="form-group col"><label>Ingrediants</label><input type ="text" placeholder="Item" name="ingri['+room+']" class="form-control item_name"><div id="name_list" style="z-index: 1;position:absolute;"></div>   </div><div class="form-group col"><label>Amounts</label><input type ="text" placeholder="Amounts" name="amount['+room+']" class="form-control"></div></div>';
            objTo.appendChild(divtest);
            document.getElementById('length').value = room+1;
            var hello = document.getElementById("length").value
            //console.log(hello);
        } 
    </script>
    
@endsection