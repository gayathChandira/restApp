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
        {!! Form::open(['action'=> 'VendorController@setVendor', 'method' =>'POST'])!!}
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
       
        <div class="form-group">
                {{Form::label('fooditems', 'Food-items')}}
                {{Form::text('fooditems', '', ['class' =>'form-control','id'=>'item_name','placeholder'=>'Item Names'])}}
                <div id="name_list" style="z-index: 1;position:absolute;"></div>
                <div class="list-group-flush" id="div_cover">
                    
                </div>
        </div>  
        <input type="hidden" id="food_ids" name="food_ids">  
        <input type="hidden" id="length" name="length">  
        <br><br><br><br><br>
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
    {!! Form::close() !!}
    </div>
    <!--/.Panel 1-->
    <!--Panel 2-->
    <div class="tab-pane fade" id="panel2" role="tabpanel">
        <br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus
            reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione
            porro voluptate odit minima.</p>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus
            reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione
            porro voluptate odit minima.</p>
    </div>
    <!--/.Panel 2-->
    <!--Panel 3-->
    <div class="tab-pane fade" id="panel3" role="tabpanel">
        <br>
        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit. Nihil odit magnam minima, soluta doloribus
            reiciendis molestiae placeat unde eos molestias. Quisquam aperiam, pariatur. Tempora, placeat ratione
            porro voluptate odit minima.</p>
    </div>
    <!--/.Panel 3-->
</div>

<script>
    $(document).ready(function(){        
        //Load the item names when user types the name 
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
        if($('#item_name').keyup()){
            var count =1;
            var arr = [];
            $(document).on('click', '#list2', function(){  
                //food-item list show in the div named div_cover  
                $('#div_cover').append('<li class="list-group-item"id="item_names'+count+'"></li>');
                $('#item_names'+count+'').text($(this).text());                
                count ++;
                $('#name_list').fadeOut();
                var query =$(this).text(); 
                console.log("what is this"+$(this).text());
                //get item id when given the item name
                if(query != ''){   
                    console.log("what inside "+$(this).text());                                 
                    var _token = $('input[name="_token"]').val();
                    $.ajax({
                        url:"{{ route('FoodItemController.fetchID')}}",   
                        method:"POST",
                        data:{query:query,_token:_token},                        
                        success:function(data){   
                            //create a array of food items' IDs 
                            arr.push(data);
                            console.log(count);
                            console.log(arr);
                            document.getElementById('food_ids').value = arr;
                            document.getElementById('length').value = (count-1);
                        }        
                    })                                       
                }               
            });            
        }
    }); 
</script>
@endsection