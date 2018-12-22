@extends('accountant')
@section('content')
    <div class="card-body">
        <h2>Set price</h2>
        <form>
            <div class="form-row">
                <div class="col-md-5 form-group">
                    <input type="text" id="dish_name" class="form-control" placeholder="Dish Name">
                    <div id="name_list" style="z-index: 1;position:absolute;"></div>    
                </div>
                {{ csrf_field() }}  
                <div class="col-md-5 form-group">
                    <input type="text" id="price" class="form-control" placeholder="Unit Price (Rs)">
                </div> 
                <div class="form-group col-md-2">
                    <a href="#" onclick="priceSet(document.getElementById('dish_name').value , document.getElementById('price').value)" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                </div>                   
            </div>
            
        </form>
    </div>


    <script>
        //Load dish names when user typing it
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
        
        function priceSet(dish_name,price){
            console.log(dish_name);
            console.log(price);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('PriceController.store') }}",
                type: "POST",
                //dataType: 'json',
                data: { 
                    dish_name:dish_name, price:price,                
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
