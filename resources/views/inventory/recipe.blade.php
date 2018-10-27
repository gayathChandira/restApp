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
                <div class="col-md-4 form-group"  >
                    {{Form::label('ingredients', 'Ingredients')}}
                    {{Form::text('ingri[0]', '', ['class' =>'form-control item_name0', 'placeholder'=>'Item', 'id'=>'ingri'])}}
                    <div id="name_list0" style="z-index: 1;position:absolute;"></div>     
                                        
                </div> 
                <div class="col-md-4 form-group ">
                    {{Form::label('amounts', 'Amounts')}}
                    {{Form::text('amount[0]', '', ['class' =>'form-control', 'placeholder'=>'Amounts', 'id'=>'amount'])}}
                </div> 
                <input type="button" class="btn btn-primary" id="more_fields" onclick="add_fields();" value="Add More" />
                <div class="col-md-4 card mb-4" >
                    <div class="card-body" id="thelist">
                        {{-- popup parts --}}                       
                    </div>                    
                </div>
            </div>  
        </div>   
        <br><br><br>   
              
         <br><br><br><br><br>
        
        <div style="display:block;">
            {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
        </div>
        
    {!! Form::close() !!}
 
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
      
        function add_fields() {         //when clicking the ad more button  
            room++;            
            var objTo = document.getElementById('thelist');
            var divtest = document.createElement("div");
            divtest.innerHTML = '<form><div class="form-row">\
            <div class="form-group col"><label>'+document.getElementById('ingri').value+'</label></div>\
            <div class="form-group col"><label>'+document.getElementById('amount').value+'</label></div>\
            <div class="form-group col"><a href="#" onclick="storing(\''+document.getElementById('item_ID').value+'\',\''+document.getElementById('ingri').value+'\',\''+document.getElementById('amount').value+'\',\''+room+'\')" \
            id="clickX['+room+']" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a></div>\
            <div class="form-group col"><a href="#" onclick="deleting(\''+document.getElementById('item_ID').value+'\',\''+document.getElementById('ingri').value+'\',\''+document.getElementById('amount').value+'\',\''+room+'\')" \
            id="clickX['+room+']" class="btn btn-danger btn-sm"><i class="fa fa-close" aria-hidden="true"></i></a></div>\
            </div>  {{ csrf_field() }}  <input type="hidden" name="loopLength" id="length"/> </form>    ';           
            objTo.appendChild(divtest);
            //document.getElementById('length').value = room+1;
            //var hello = document.getElementById("length").value            
        }


        //when user clicks the green color button the data will be stord in db
        function storing(dname,ingri,amount,length) {
            document.getElementById('ingri').value = '';
            document.getElementById('amount').value = '';
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('RecipeController.store1') }}",
                type: "POST",
                //dataType: 'json',
                data: { 
                    dname: dname,ingri:ingri,amount:amount,length:length,                  
                    _token:_token                                     
                },                
                success: function(data) {
                    $('#name_list0').fadeIn();
                    $('#name_list0').html(data); 
                    },
                error: function(jqXHR, textStatus, errorThrown,data) { // What to do if we fail
                    console.log(data); 
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }               
            });
        }
        

        function deleting(dname,ingri,amount,length) {
            document.getElementById('ingri').value = '';
            document.getElementById('amount').value = '';
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('RecipeController.delete') }}",
                type: "POST",
                //dataType: 'json',
                data: { 
                    dname: dname,ingri:ingri,amount:amount,length:length,                  
                    _token:_token                                     
                },                
                success: function(data) {
                    $('#name_list0').fadeIn();
                    $('#name_list0').html(data); 
                    },
                error: function(jqXHR, textStatus, errorThrown,data) { // What to do if we fail
                    console.log(data); 
                    console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
                }               
            });
        }
       
    </script>
    
@endsection