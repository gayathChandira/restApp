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
    <div class="col-md-4 ">        
        <div class="card card-cascade wider">        
            <div class="view view-cascade gradient-card-header peach-gradient">           
                <h2 class="card-header-title mb-3">The Bill</h2>      
            </div>       
            <div class="card-body card-body-cascade text-center" id="billtable">         
                {{-- bill will appear here --}}
            </div>     
      </div>  
    </div>
</div>
<div class="card mb-4 mt-5 ">
    <div class="card-body" id="dishcard">
            {{ csrf_field() }} 
            {{-- dishcards will apear here --}}
        <div class="row">
            <div class="col-md-4" >ddd</div>
            <div class="col-md-4" >vvv</div>
            <div class="col-md-4 border border-primary rounded">
                <h3>Rice</h3>
                @foreach($rice as $ric)                    
                    <div>
                        <a href="#" onclick="order('{{$ric->dish_name}}')" class="btn btn-li btn-lg"> {{$ric->dish_name}}</a>          
                    </div>
                @endforeach
                
            </div>
        </div>
    </div>
</div>        
<script>

    // $(document).ready(function(){
    //     console.log('iside');
    //     var _token = $('input[name="_token"]').val();
    //     $.ajax({
    //         url:"{{ route('BillController.dishDiv')}}",    
    //         method:"POST",
    //         data:{ _token:_token},
    //         success:function(data){        
    //             $('#dishcard').html(data);
    //         }           
    //     })
    // });
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

    //store in bill table in db 
    var num =0;
    function store(dish_name,quantity){  
        document.getElementById('dish_name').value = '';
        document.getElementById('quantity').value = ''; 
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url: "{{ route('BillController.store') }}",
            type: "POST",
            //dataType: 'json',
            data: { 
                dish_name:dish_name, quantity:quantity, num: num,               
                _token:_token                                     
            },                
            success: function() {             
                num ++;
                //bill appear             
                var _token = $('input[name="_token"]').val();   
                $.ajax({
                    url:"{{ route('BillController.makeTable')}}",    
                    method:"POST",
                    data:{ dish_name:dish_name, _token:_token},
                    success:function(data){        
                        $('#billtable').html(data);
                    }           
                });
            },
            error: function(jqXHR, textStatus, errorThrown,data) { // What to do if we fail
                console.log(data); 
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }               
        });
    }
    //remove items from the bill
    function remove(bill_id){        
        var _token = $('input[name="_token"]').val();   
            $.ajax({
                url:"{{ route('BillController.billRemove')}}",    
                method:"POST",
                data:{ bill_id:bill_id, _token:_token},
                success:function(){    
                      
                   //bill appear             
                    var _token = $('input[name="_token"]').val();   
                    $.ajax({
                        url:"{{ route('BillController.makeTable')}}",    
                        method:"POST",
                        data:{  _token:_token},
                        success:function(data){        
                            $('#billtable').html(data);
                        }           
                    });
                }           
            });
    }
    //when click proceed button 
    function paid(){
        var _token = $('input[name="_token"]').val();   
        $.ajax({
            url:"{{ route('BillController.storePaid')}}",    
            method:"POST",
            data:{ _token:_token},
            success:function(data){                            
                $('#name_list').fadeIn();
                $('#name_list').html(data);
            }           
        })
    }
    //when click dishdiv buttons
    function order(dish_name){        
        console.log(dish_name);
        var quantity =1; 
        var _token = $('input[name="_token"]').val();   
        $.ajax({
            url: "{{ route('BillController.store') }}",
            type: "POST",
            //dataType: 'json',
            data: { 
                dish_name:dish_name, quantity:quantity, num: num,               
                _token:_token                                     
            },                
            success: function() {             
                num ++;
                //bill appear             
                var _token = $('input[name="_token"]').val();   
                $.ajax({
                    url:"{{ route('BillController.makeTable')}}",    
                    method:"POST",
                    data:{ dish_name:dish_name, _token:_token},
                    success:function(data){        
                        $('#billtable').html(data);
                    }           
                });
            },
            error: function(jqXHR, textStatus, errorThrown,data) { // What to do if we fail
                console.log(data); 
                console.log("AJAX error: " + textStatus + ' : ' + errorThrown);
            }               
        });
    }
</script>
@endsection