@extends('accountant')
@section('content')


    <div class="card mb-4 wow fadeIn ">        
        <div class="card-body">
            <div id="message"></div>
            <h2>Set price</h2>
            <form>
                <div class="form-row">
                    <div class="col-md-5 form-group">
                        <input type="text" id="dish_name" class="form-control" placeholder="Dish Name" autocomplete ='off'>
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
    </div>

    <div class="card mb-4 wow fadeIn mt-5">        
            <div class="card-body">
                <div id="message"></div>
                <h2>Edit price</h2>
                <form>
                    <div class="form-row">
                        <div class="col-md-5 form-group">
                            <input type="text" id="dish_name1" class="form-control" placeholder="Dish Name" autocomplete ='off'>
                            <div id="name_list1" style="z-index: 1;position:absolute;"></div>    
                        </div>
                        {{ csrf_field() }}  
                        <div class="col-md-5 form-group">
                            <input type="text" id="price1" class="form-control" placeholder="Unit Price (Rs)">
                        </div> 
                        <div class="form-group col-md-2">
                            <a href="#" onclick="priceEdit(document.getElementById('dish_name1').value , document.getElementById('price1').value)" class="btn btn-success btn-sm"><i class="fa fa-check" aria-hidden="true"></i></a>
                        </div>                   
                    </div>
                    
                </form>
            </div>
        </div>
    <script>
        //set price
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
                document.getElementById('dish_name1').value = '';
                $('#name_list').fadeOut();               
        });
        
        //when click the green check button
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
                    }        
            });
            var success = '<div class="alert alert-success">\
            Successfully Set the Price!       \
            </div> ';
            $('#message').html(success);
            
            setTimeout(function() {
                location.reload();
            }, 1000);
        } 


        //edit price   
        //Load dish names when user typing it
        $('#dish_name1').keyup(function(){
            var query = $(this).val();                                      
            if(query != ''){                    
                var _token = $('input[name="_token"]').val();
                $.ajax({
                    url:"{{ route('BillController.fetchName')}}",    
                    method:"POST",
                    data:{query:query, _token:_token},
                    success:function(data){                            
                        $('#name_list1').fadeIn();
                        $('#name_list1').html(data);
                    }           
                })
            }
        });
        $(document).on('click', '#list2', function(){                
                $('#dish_name1').val($(this).text());
                document.getElementById('dish_name').value = '';
                $('#name_list1').fadeOut();               
        });

        //when click the green check button
        function priceEdit(dish_name,price){
            console.log(dish_name);
            console.log(price);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url: "{{ route('PriceController.edit') }}",
                type: "POST",
                //dataType: 'json',
                data: { 
                    dish_name:dish_name, price:price,                
                    _token:_token                                     
                },                
                success: function(data) {                    
                    }        
            });
            var success = '<div class="alert alert-success">\
            Successfully Edit the Price!       \
            </div> ';
            $('#message').html(success);
            
            setTimeout(function() {
                location.reload();
            }, 1000);
        } 
    </script>
@endsection
