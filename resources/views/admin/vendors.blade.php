@extends('admin')

@section('content')
    <!-- Nav tabs -->
<ul class="nav nav-tabs md-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">Add Vendor</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">Edit Vendor</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">Remove Vendor</a>
    </li>
</ul>
<!-- Tab panels -->
<div class="tab-content card">
    <!--Panel 1-->
    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
        <br>
        {!! Form::open(['action'=> 'VendorController@setVendor', 'method' =>'POST', 'autocomplete' =>'off'])!!}
        <div class="form-group">
            {{Form::label('fname', 'First Name')}}
            {{Form::text('fname', '', ['class' =>'form-control', 'placeholder'=>'First Name'])}}
        </div>   
        
        <div class="form-group">
                {{Form::label('lname', 'Last Name')}}
                {{Form::text('lname', '', ['class' =>'form-control', 'placeholder'=>'Last Name'])}}
        </div> 
        <div class="form-group">
                {{Form::label('contact', 'Contact')}}
                {{Form::text('contact', '', ['class' =>'form-control', 'placeholder'=>'Contact Number'])}}
        </div> 
        <div class="form-group">
                {{Form::label('email', 'Email')}}
                {{Form::text('email', '', ['class' =>'form-control', 'placeholder'=>'Email Address'])}}
        </div> 
        {{ csrf_field() }}
        <div class="form-group">
                {{Form::label('fooditems', 'Food-items')}}
                {{Form::text('fooditems', '', ['class' =>'form-control','id'=>'item_name','placeholder'=>'Item Names'])}}
                <div id="name_list" style="z-index: 1;position:absolute;"></div>
                <div class="list-group-flush" id="div_cover"></div>
        </div>  
        <input type="hidden" id="food_ids" name="food_ids">  
        <input type="hidden" id="length" name="length">  
        <br><br><br><br><br>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
    {!! Form::close() !!}
    </div>
    <!--/.Panel 1-->
    <!--Panel 2 Edit Vendor-->
    <div class="tab-pane fade" id="panel2" role="tabpanel">
        <br>
        <h5>Enter Vendor ID or Name to Update</h5>
        <form>
            <div class="form-row">
                <div class="form-group col">
                    <label>ID</label>
                    <input type="text" class="form-control" id="vendor_id" placeholder="Vendor ID">
                    <div id="id_list" style="z-index: 1;position:absolute;"></div>  
                </div>   
                <div class="form-group col" style="text-align:center;margin-top:27px;"><h1>OR</h1> </div>  
                
                <div class="form-group col"> 
                    <label>Name</label>
                    <input type="text" class="form-control" id="vendor_name" placeholder="Vendor Name">
                    <div id="ven_list" style="z-index: 1;position:absolute;"></div> 
                </div> 
            </div>
            <input type="button" value="Make changes" id="submit_btn" class="btn btn-primary" >
        </form><br><br><br><br><br>            
        {!! Form::open(['action'=> 'VendorController@updateVendor', 'method' =>'POST','id'=>'new_form','autocomplete' =>'off'])!!}
        

        {!! Form::close() !!}       
    </div>
    <!--/.Panel 2-->
    <!--Panel 3 Remove Vendor-->
    <div class="tab-pane fade" id="panel3" role="tabpanel">
        <br>
        <h5>Enter Vendor ID or Name to Remove</h5>        
        {!! Form::open(['action'=> 'VendorController@removeVendor', 'method' =>'POST' , 'autocomplete' =>'off'])!!}        
            <div class="form-row">
                <div class="form-group col">
                    {{Form::label('vendorid', 'ID')}}
                    {{Form::text('vendorid', '', ['class' =>'form-control','id'=>'vendor_id1' ,'placeholder'=>'Vendor ID'])}}                    
                    <div id="id_list1" style="z-index: 1;position:absolute;"></div>  
                </div>   
                <div class="form-group col" style="text-align:center;margin-top:27px;"><h1>OR</h1> </div>  
              
                <div class="form-group col">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name', '', ['class' =>'form-control','id'=>'vendor_name1' ,'placeholder'=>'Vendor ID'])}}                    
                    <div id="ven_list1" style="z-index: 1;position:absolute;"></div> 
                </div> 
            </div>            
        {{Form::submit('Remove', ['class' => 'btn btn-primary'])}} 
        {!! Form::close() !!}
        <br><br><br><br><br>
    </div>
    <!--/.Panel 3-->
</div>

<script>
    $(document).ready(function(){
        //Add Vendor -------------------------------- 
        
        //Load the item names when user types the name 
        $('#item_name').keyup(function(){
            var query = $(this).val();                            
            if(query != ''){                    
                var _token = $('input[name="_token"]').val();
                console.log( _token ); 
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
        if($('#item_name').keyup()){
            var count =1;
            var arr = [];
            $(document).on('click', '#list2', function(){ 
                $('#item_name').val(''); 
                //food-item list show in the div named div_cover  
                $('#div_cover').append('<li class="list-group-item"id="item_names'+count+'"></li>');
                $('#item_names'+count+'').text($(this).text());                
                count ++;
                $('#name_list').fadeOut();
                var query =$(this).text(); 
                
                //get item id when given the item name
                if(query != ''){   
                                                   
                    var _token = $('input[name="_token"]').val();
                   
                    $.ajax({
                        url:"{{ route('FoodItemController.fetchID')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            //create a array of food items' IDs 
                            arr.push(data);                            
                            document.getElementById('food_ids').value = arr;
                            document.getElementById('length').value = (count-1);
                        }        
                    })                                       
                }               
            });            
        }
        //Edit Vendor -------------------------------- 
        //get vendor id when user type vendor id 
        $('#vendor_id').keyup(function(){               
                var query = $(this).val();                                    
                if(query != ''){                    
                    var _token = $('input[name="_token"]').val();                                       
                    $.ajax({
                        url:"{{ route('VendorController.fetchID')}}",    
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){                                                     
                            $('#id_list').fadeIn();
                            $('#id_list').html(data);
                        }           
                     })
                }
        });
        //set the vendor name when use clicks the vendor id
        $(document).on('click', '#list1', function(){                
                $('#vendor_id').val($(this).text());
                $('#id_list').fadeOut();  
                var query =$(this).text(); 
                if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('VendorController.fetchVendorName')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            $('#vendor_name').val(data);
                        }        
                     })
                     
                }
            });
        //Get vendor name when use type the vendor name
        $('#vendor_name').keyup(function(){
                var query = $(this).val();                            
                if(query != ''){                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('VendorController.fetchNameWhenType')}}",    
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){                            
                            $('#ven_list').fadeIn();
                            $('#ven_list').html(data);
                        }           
                     })
                }
        });
        //set vendor-id when user selcts the vendor name from the dropdown list
        if($('#item_name').keyup()){ 
                $(document).on('click', '#list2', function(){                
                $('#vendor_name').val($(this).text());
                $('#ven_list').fadeOut();  
                var query =$(this).text(); 
                if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('VendorController.fetchvendorID')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            $('#vendor_id').val(data);
                            
                        }        
                     })
                     
                }    
            });
        }  //Load new form when your selects vendor id or vendor name 
        $(document).on('click', '#submit_btn', function(){            
            if(document.getElementsByClassName("editform")){                
                $('.editform').fadeOut('slow', function() {
                    $(this).hide();
                });                
            }  
            var query = document.getElementById('vendor_id').value;       
            if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();                    
                    $.ajax({
                        url:"{{ route('VendorController.editVendor')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){                                             
                            $('#new_form').append(data);
                        }        
                     })
                     
                }  
        });

        //Remove Vendor---------------------------------------------
        //get vendor id when user type vendor id 
        $('#vendor_id1').keyup(function(){               
                var query = $(this).val();                                    
                if(query != ''){                    
                    var _token = $('input[name="_token"]').val();                                       
                    $.ajax({
                        url:"{{ route('VendorController.fetchID')}}",    
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){                                                     
                            $('#id_list1').fadeIn();
                            $('#id_list1').html(data);
                        }           
                     })
                }
        });
        //set the vendor name when use clicks the vendor id
        $(document).on('click', '#list1', function(){                
                $('#vendor_id1').val($(this).text());
                $('#id_list1').fadeOut();  
                var query =$(this).text(); 
                if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('VendorController.fetchVendorName')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            $('#vendor_name1').val(data);
                        }        
                     })
                     
                }
            });
        //Get vendor name when use type the vendor name
        $('#vendor_name1').keyup(function(){
                var query = $(this).val();                            
                if(query != ''){                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('VendorController.fetchNameWhenType')}}",    
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){                            
                            $('#ven_list1').fadeIn();
                            $('#ven_list1').html(data);
                        }           
                     })
                }
        });
        //set vendor-id when user selcts the vendor name from the dropdown list
        if($('#item_name').keyup()){ 
                $(document).on('click', '#list2', function(){                
                $('#vendor_name1').val($(this).text());
                $('#ven_list1').fadeOut();  
                var query =$(this).text(); 
                if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('VendorController.fetchvendorID')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            $('#vendor_id1').val(data);
                            
                        }        
                     })
                     
                }    
            });
        }
    }); 
</script>
@endsection





