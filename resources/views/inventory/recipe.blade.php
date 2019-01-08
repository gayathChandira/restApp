@extends('inventoryMgr')

@section('content')
    <div id="message"></div>
    <h1 class="card-title" style="padding-left: 10px;">Make a New Recipe</h1>
    {!! Form::open(['autocomplete' =>'off'])!!}
        <div class="form-group" style="padding-left: 10px;">
            {{Form::label('recipeName', 'Meal Name')}}
            {{Form::text('recipeName', '', ['class' =>'form-control', 'placeholder'=>'Recipe', 'id'=>'item_ID' ,'required' => 'required'])}}
            <!-- {{-- <input type="text" class="form-control" id="item_ID"> --}} -->
            <div id="item_list" style="z-index: 1;position:absolute;"></div>            
        </div>

        <label style="padding-left: 10px;">Dish Type</label>
    
        <div class="form-check" style="padding-left: 10px;">
            <input type="radio" class="form-check-input" id="materialGroupExample1" name="dishType" value="shorteats">
            <label class="form-check-label" for="materialGroupExample1">Short Eats</label>
        </div>     
        <div class="form-check" style="padding-left: 10px;">
            <input type="radio" class="form-check-input" id="materialGroupExample2" name="dishType" value="rice">
            <label class="form-check-label" for="materialGroupExample2">Rice</label>
        </div>      
        <div class="form-check" style="padding-left: 10px;">
            <input type="radio" class="form-check-input" id="materialGroupExample3" name="dishType" value="noodles">
            <label class="form-check-label" for="materialGroupExample3">Noodles</label>
        </div>
        <div class="form-check" style="padding-left: 10px;">
            <input type="radio" class="form-check-input" id="materialGroupExample4" name="dishType" value="soups">
            <label class="form-check-label" for="materialGroupExample4">Soups</label>
        </div>
        <div class="form-check" style="padding-left: 10px;">
            <input type="radio" class="form-check-input" id="materialGroupExample5" name="dishType" value="beverages">
            <label class="form-check-label" for="materialGroupExample5">Beverages</label>
        </div>

        {{ csrf_field() }}  
        <div id="room_fileds" style="padding-left: 10px;">
            <div class="form-row mt-4">
                <div class="col-md-4 form-group"  >
                    {{Form::label('ingredients', 'Ingredients')}}
                    {{Form::text('ingri[0]', '', ['class' =>'form-control item_name0', 'placeholder'=>'Item', 'id'=>'ingri', 'required'])}}
                    <div id="name_list0" style="z-index: 1;position:absolute;"></div>     
                                        
                </div> 
                <div class="col-md-4 form-group ">
                    {{Form::label('amounts', 'Amounts')}}
                    {{Form::text('amount[0]', '', ['class' =>'form-control', 'placeholder'=>'Amount (grams/units)', 'id'=>'amount', 'required'])}}
                </div> 
                <a class="btn btn-primary btn-lg" style="height: fit-content;top: 9px;" id="more_fields" onclick="add_fields();">Add More</a> 
                <div class="col-md-4 card mb-4" style="display: none" id="card">
                    <div class="card-body"  id="thelist">
                        {{-- popup parts --}}                       
                    </div>                    
                </div>
            </div>  
        </div>   
        <br><br><br>   
              
         <br><br><br><br><br>
        
        <div style="display:block; padding-left: 10px; padding-top: 5px;">
                {{ csrf_field() }}
                <a onclick="submit()" class="btn btn-primary btn-lg">Submit</a>
        </div><!-- Edited button size and padding -->
        
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


        //when clicking the ad more button
        function add_fields() {
            if(document.getElementById('ingri').value==""||document.getElementById('amount')==""){
                window.alert("No ingredients or amount added!");
            }         
            else{
                room++;    
                document.getElementById('card').style.display = "block";      
                var objTo = document.getElementById('thelist');
                var divtest = document.createElement("div");
                divtest.innerHTML = '<form><div class="form-row">\
                <div class="form-group col"><label>'+document.getElementById('ingri').value+'</label></div>\
                <div class="form-group col"><label>'+document.getElementById('amount').value+'</label></div>\
                <div class="form-group col"><a href="#" onclick="storing(\''+document.getElementById('item_ID').value+'\',\''+document.querySelector('input[type = radio]:checked').value+'\',\''+document.getElementById('ingri').value+'\',\''+document.getElementById('amount').value+'\',\''+room+'\')" \
                id="clickX['+room+']" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a></div>\
                <div class="form-group col"><a href="#" onclick="deleting(\''+document.getElementById('item_ID').value+'\',\''+document.getElementById('ingri').value+'\',\''+document.getElementById('amount').value+'\',\''+room+'\')" \
                id="clickX['+room+']" class="btn btn-danger btn-sm"><i class="fa fa-close" aria-hidden="true"></i></a></div>\
                </div>  {{ csrf_field() }}  <input type="hidden" name="loopLength" id="length"/> </form>    ';           
                objTo.appendChild(divtest);
                //document.getElementById('length').value = room+1;
                //var hello = document.getElementById("length").value 
            }           
        }


        //when user clicks the green color button the data will be stord in db
        function storing(dname,dtype,ingri,amount,length) {
            document.getElementById('ingri').value = '';
            document.getElementById('amount').value = '';
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('RecipeController.store1') }}",
                type: "POST",
                //dataType: 'json',
                data: { 
                    dname: dname,dtype:dtype,ingri:ingri,amount:amount,length:length,                  
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
            console.log(dname);
            console.log(ingri);
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
        

        //when click submit button
        var recipe_name = document.getElementById("item_ID").value;
        function submit(){
            
                console.log('submit');
                var success = '<div class="alert alert-success">\
                Successfully Added!       \
                </div> ';
                $('#message').html(success);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            
        }
    </script>
    
@endsection