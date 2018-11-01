@extends('cashier')

@section('content')
<div class="row">
    <div class="col-md-8">
        <div class="card mb-4 ">
            <div class="card-body">
                <h2>Order Bill</h2>
                <form>
                    <div class="form-row">
                        <div class="col-md-5 form-group">
                            <input type="text" id="dish_name" class="form-control" placeholder="Dish Name">
                            <div id="name_list" style="z-index: 1;position:absolute;"></div>    
                        </div>
                        {{ csrf_field() }}  
                        <div class="col-md-5 form-group">
                            <input type="text" id="quantity" class="form-control" placeholder="Quantity">
                        </div> 
                        <div class="form-group col-md-2">
                            <a href="#" onclick="store(document.getElementById('dish_name').value, document.getElementById('quantity').value)" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                        </div>                   
                    </div>
                    
                </form>
            </div>
                        
        </div>    
    </div>
    <div class="col-md-4">
        <!-- Card -->
<div class="card card-cascade wider">

        <!-- Card image -->
        <div class="view view-cascade gradient-card-header peach-gradient">
      
          <!-- Title -->
          <h2 class="card-header-title mb-3">The Bill</h2>          
      
        </div>
      
        <!-- Card content -->
        <div class="card-body card-body-cascade text-center" id="billtable">
      
          
      
        </div>
        <!-- Card content -->
      
      </div>
      <!-- Card -->
      

        {{-- <div class="card card-cascade wider">
            <div class="view view-cascade gradient-card-header peach-gradient">
                <h2 class="card-header-title mb-3">The Bill</h2>
            </div>  
            <div class="card-body" id="billtable">
                {{-- bill appear here 
            </div>
                         
        </div>  --}}
    </div>
</div>

<script>
    //get dish name when typing  
    $('#dish_name').keyup(function(){
        var query = $(this).val();                                      
        if(query != ''){                    
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('BillController.fetchName')}}",    
                method:"POST",
                data:{query:query, _token:_token},
                success:function(data){                            
                    $('#name_list').fadeIn();
                    $('#name_list').html(data);
                }           
            })
        }
    });
    $(document).on('click', '#list2', function(){                
            $('#dish_name').val($(this).text());
            $('#name_list').fadeOut();               
    });
    //store in bill table 
    function store(dish_name,quantity){
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('BillController.store') }}",
            type: "POST",
            //dataType: 'json',
            data: { 
                dish_name:dish_name, quantity:quantity,                
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
        
            
        $.ajax({
            url:"{{ route('BillController.makeTable')}}",    
            method:"POST",
            data:{ dish_name:dish_name, _token:_token},
            success:function(data){                            
                
                $('#billtable').html(data);
            }           
        })

    }    
</script>
@endsection