@extends('inventoryMgr')
@section('content')
<div id="message"></div>
<h1 class="card-title">Issue Food-Items to Kitchen</h1>
<form>
    <div class="form-row mt-5">
        <div class="col-md-5 form-group" style="padding-top:7px;">
            <input type="text" id="item_name" class="form-control" placeholder="Food Item Name">
            <div id="name_list" style="z-index: 1;position:absolute;"></div>    
        </div>
        {{ csrf_field() }}  
        <div class="col-md-5 form-group" style="padding-top:7px;">
            <input type="text" id="quantity" class="form-control" placeholder="Quantity (kg/Units)">
        </div>            
        <div class="form-group col-md-2">
            <a href="#" onclick="store(document.getElementById('item_name').value, document.getElementById('quantity').value)" class="btn btn-success btn-md"><i class="fa fa-check" aria-hidden="true"></i></a>
        </div> <!-- Changed button size and allign text boxes -->
                        
    </div>
</form>
<div class="col-md-4">        
    <!-- <div class="card card-cascade wider mt-5">                 -->
        <div class="card-body card-body-cascade text-center" id="issued">         
            {{-- issued items will appear here --}}
        </div>     
    <!-- </div>   -->
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

    
    if($('#item_name').keyup()){ 
        $(document).on('click', '#list2', function(){                
            $('#item_name').val($(this).text());
            $('#name_list').fadeOut();  
        });
    }
    //store food items in temp table
    var num =0;
    function store(item_name,quantity){  
        document.getElementById('item_name').value = '';
        document.getElementById('quantity').value = '';    
         
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('IssueFoodItemsController.store') }}",
            type: "POST",            
            data: { 
                item_name:item_name, quantity:quantity, num:num,               
                _token:_token                                     
            },                
            success: function() {     
                
                num ++;
                //issued appear             
                var _token = $('input[name="_token"]').val();   
                $.ajax({
                    url:"{{ route('IssueFoodItemsController.makeTable')}}",    
                    method:"POST",
                    data:{ item_name:item_name, _token:_token},
                    success:function(data){        
                        $('#issued').html(data);
                    }           
                }); 
            },
            error: function(jqXHR, textStatus, errorThrown,data) { // What to do if we fail
                console.log(data); 
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }               
        });
    }
    //remove items from the issued
    function remove(food_item){        
        var _token = $('input[name="_token"]').val();   
        $.ajax({
            url:"{{ route('IssueFoodItemsController.issueRemove')}}",    
            method:"POST",
            data:{ food_item:food_item, _token:_token},
            success:function(){    
                    
                //issued appear             
                var _token = $('input[name="_token"]').val();   
                $.ajax({
                    url:"{{ route('IssueFoodItemsController.makeTable')}}",    
                    method:"POST",
                    data:{ _token:_token},
                    success:function(data){        
                        $('#issued').html(data);
                    }           
                });
            }           
        });
    }

    //when click proceed button 
    function submit(){
        var _token = $('input[name="_token"]').val();   
        $.ajax({
            url:"{{ route('IssueFoodItemsController.submit')}}",    
            method:"POST",
            data:{ _token:_token},
            success:function(data){                            
                $('#name_list').fadeIn();
                $('#name_list').html(data);
                
                console.log('submit');
                var success = '<div class="alert alert-success">\
                Successfully Added!       \
                </div> ';
                $('#message').html(success);
                setTimeout(function() {
                    location.reload();
                }, 1000);
            }           
        })
    }    
</script>
@endsection