@extends('admin')

@section('content')
    <!-- Nav tabs -->
<ul class="nav nav-tabs md-tabs nav-justified">
    <li class="nav-item">
        <a class="nav-link active" data-toggle="tab" href="#panel1" role="tab">Add Employee</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel2" role="tab">Edit Employee</a>
    </li>
    <li class="nav-item">
        <a class="nav-link" data-toggle="tab" href="#panel3" role="tab">Remove Employee</a>
    </li>
</ul>
<!-- Tab panels -->
<div class="tab-content card">
    <!--Panel 1 add employee -->
    <div class="tab-pane fade in show active" id="panel1" role="tabpanel">
        <br>
        {!! Form::open(['action'=> 'EmployeeController@setEmployee', 'method' =>'POST', 'autocomplete' =>'off'])!!}
        <div class="form-group">
            {{Form::label('fname', 'First Name')}}
            {{Form::text('fname', '', ['class' =>'form-control', 'placeholder'=>'First Name'])}}
        </div>   
        
        <div class="form-group">
                {{Form::label('lname', 'Last Name')}}
                {{Form::text('lname', '', ['class' =>'form-control', 'placeholder'=>'Last Name'])}}
        </div>
        <div class="form-group">
            {{Form::label('age', 'Age')}}
            {{Form::text('age', '', ['class' =>'form-control', 'placeholder'=>'Age'])}}
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
        
      
        <input type="hidden" id="length" name="length">  
        <br><br><br><br><br>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
    {!! Form::close() !!}
    </div>
    <!--/.Panel 1-->
    <!--Panel 2 Edit employee-->
    <div class="tab-pane fade" id="panel2" role="tabpanel">
        <br>
        <h5>Enter Employee ID or Name to Update</h5>
        <form>
            <div class="form-row">
                <div class="form-group col">
                    <label>ID</label>
                    <input type="text" class="form-control" id="emp_id" placeholder="Employee ID">
                    <div id="id_list" style="z-index: 1;position:absolute;"></div>  
                </div>   
                <div class="form-group col" style="text-align:center;margin-top:27px;"><h1>OR</h1> </div>  
                
                <div class="form-group col"> 
                    <label>Name</label>
                    <input type="text" class="form-control" id="emp_name" placeholder="Employee Name">
                    <div id="ven_list" style="z-index: 1;position:absolute;"></div> 
                </div> 
            </div>
            <input type="button" value="Make changes" id="submit_btn" class="btn btn-primary" >
        </form><br><br><br><br><br>            
        {!! Form::open(['action'=> 'EmployeeController@updateEmployee', 'method' =>'POST','id'=>'new_form','autocomplete' =>'off'])!!}
        

        {!! Form::close() !!}       
    </div>
    <!--/.Panel 2-->
    <!--Panel 3 Remove Vendor-->
    <div class="tab-pane fade" id="panel3" role="tabpanel">
        <br>
        <h5>Enter Employee ID or Name to Remove</h5>        
        {!! Form::open(['action'=> 'EmployeeController@removeEmployee', 'method' =>'POST' , 'autocomplete' =>'off'])!!}        
            <div class="form-row">
                <div class="form-group col">
                    {{Form::label('empid', 'ID')}}
                    {{Form::text('empid', '', ['class' =>'form-control','id'=>'emp_id1' ,'placeholder'=>'Employee ID'])}}                    
                    <div id="id_list1" style="z-index: 1;position:absolute;"></div>  
                </div>   
                <div class="form-group col" style="text-align:center;margin-top:27px;"><h1>OR</h1> </div>  
              
                <div class="form-group col">
                    {{Form::label('name', 'Name')}}
                    {{Form::text('name', '', ['class' =>'form-control','id'=>'emp_name1' ,'placeholder'=>'Employee Name'])}}                    
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
        //Edit Employee -------------------------------- 
        //get employee id when user type employee id 
        $('#emp_id').keyup(function(){               
                var query = $(this).val();                                    
                if(query != ''){                    
                    var _token = $('input[name="_token"]').val();                                       
                    $.ajax({
                        url:"{{ route('EmployeeController.fetchID')}}",    
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){                                                     
                            $('#id_list').fadeIn();
                            $('#id_list').html(data);
                        }           
                     })
                }
        });
        //set the employee name when use clicks the employee id
        $(document).on('click', '#list1', function(){                
                $('#emp_id').val($(this).text());
                $('#id_list').fadeOut();  
                var query =$(this).text(); 
                if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('EmployeeController.fetchEmployeeName')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            $('#emp_name').val(data);
                        }        
                     })
                     
                }
            });
        //Get employee name when use type the employee name
        $('#emp_name').keyup(function(){
                var query = $(this).val();                            
                if(query != ''){                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('EmployeeController.fetchNameWhenType')}}",    
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){                            
                            $('#ven_list').fadeIn();
                            $('#ven_list').html(data);
                        }           
                     })
                }
        });
        //set employee-id when user selcts the employee name from the dropdown list
        if($('#item_name').keyup()){ 
                $(document).on('click', '#list2', function(){                
                $('#emp_name').val($(this).text());
                $('#ven_list').fadeOut();  
                var query =$(this).text(); 
                if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('EmployeeController.fetchemployeeID')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            $('#emp_id').val(data);
                            
                        }        
                     })
                     
                }    
            });
        }  
        //Load new form when your selects employee id or employee name 
        $(document).on('click', '#submit_btn', function(){            
            if(document.getElementsByClassName("editform")){                
                $('.editform').fadeOut('slow', function() {
                    $(this).hide();
                });                
            }  
            var query = document.getElementById('emp_id').value;       
            if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();                    
                    $.ajax({
                        url:"{{ route('EmployeeController.editEmployee')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){                                             
                            $('#new_form').append(data);
                        }        
                     })
                     
                }  
        });

        //Remove Vendor---------------------------------------------
        //get employee id when user type employee id 
        $('#emp_id1').keyup(function(){               
                var query = $(this).val();                                    
                if(query != ''){                    
                    var _token = $('input[name="_token"]').val();                                       
                    $.ajax({
                        url:"{{ route('EmployeeController.fetchID')}}",    
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){                                                     
                            $('#id_list1').fadeIn();
                            $('#id_list1').html(data);
                        }           
                     })
                }
        });
        //set the employee name when use clicks the employee id
        $(document).on('click', '#list1', function(){                
                $('#emp_id1').val($(this).text());
                $('#id_list1').fadeOut();  
                var query =$(this).text(); 
                if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('EmployeeController.fetchEmployeeName')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            $('#emp_name1').val(data);
                        }        
                     })
                     
                }
            });
        //Get employee name when use type the employee name
        $('#emp_name1').keyup(function(){
                var query = $(this).val();                            
                if(query != ''){                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('EmployeeController.fetchNameWhenType')}}",    
                        method:"POST",
                        data:{query:query, _token:_token},
                        success:function(data){                            
                            $('#ven_list1').fadeIn();
                            $('#ven_list1').html(data);
                        }           
                     })
                }
        });
        //set employee-id when user selcts the employee name from the dropdown list
        if($('#item_name').keyup()){ 
                $(document).on('click', '#list2', function(){                
                $('#emp_name1').val($(this).text());
                $('#ven_list1').fadeOut();  
                var query =$(this).text(); 
                if(query != ''){                                    
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('EmployeeController.fetchemployeeID')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            $('#emp_id1').val(data);
                            
                        }        
                     })
                     
                }    
            });
        }
    }); 
</script>
@endsection





