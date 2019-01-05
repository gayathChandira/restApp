@extends('accountant')
@section('content')
<div class="card mb-4 wow fadeIn ">        
        
<div class="card-body">
    <h2>Pay For Vendor</h2>  
    {!! Form::open(['action'=> 'FoodItemController@storenew', 'method' =>'POST','autocomplete' =>'off'])!!}
        
            <div class="form-group mt-5">
                
                {{Form::label('vendorid', 'Vendor Id')}}
                {{Form::text('vendorid', '', ['class' =>'form-control','id'=>'vendor_id', 'placeholder'=>'Enter Vendor ID', 'required'])}}
                <div id="id_list" style="z-index: 1;position:absolute;"></div>
            </div>   
            
            <div class="form-group">
                    {{Form::label('vname', 'Vendor Name')}}
                    {{Form::text('vname', '', ['class' =>'form-control','id'=>'vendor_name', 'placeholder'=>'Enter Vendor Name', 'required'])}}
                    <div id="ven_list" style="z-index: 1;position:absolute;"></div>
            </div>    
            {{ csrf_field() }} 
           
        {!! Form::close() !!}
        <div class="form-group">
            <label for="users" style="padding-right:10px;">Select Food Items: </label>
            <select name="user_id" id="items" class="form-control" multiple="multiple">
                @foreach($fooditem as $key)
                <option value="{{ $key->itemName }}">{{ $key->itemName }}</option>
                @endforeach
            </select>
        </div>

        <button type="button" onclick="makeTable()" class="btn btn-primary btn-lg" style="width:147px;">Next</button>

        <div id="table"></div>
        <button type="button" onclick="store()" class="btn btn-primary btn-lg">Proceed!</button>
</div>
</div>
<script>
    $(document).ready(function(){
        $('#items').select2({
            placeholder : 'Please Select Item ',
            tags: true,
            width: '18%'
        });
    });
    var bigarray =[];
    // Add event trigger to inputs with class auto-calc
    $(document).on("keyup change paste", "td > input.auto-calc", function() {
        
        // Determine parent row
        row = $(this).closest("tr");

        // Get first and second input values
        first = row.find("td input.unit-price").val();
        second = row.find("td input.amount").val();

        // Print input values to output cell
        total = first * second;
        row.find("td input.total-cost").val(first * second);
        if(first != '' && second != '' && total != ''){
            var smallarray =[];
            
            smallarray.push(first);
            smallarray.push(second);
            smallarray.push(total);
            bigarray.push(smallarray);
        }
        
        // Update total invoice value
        var sum = 0;
        // Cycle through each input with class total-cost
        $("input.total-cost").each(function() {
            // Add value to sum
            sum += +$(this).val();
        });
        
        // Assign sum to text of #total-invoice
        // Using the id here as there is only one of these
        $("#total-invoice").text(sum);
        
        
    });
   
    
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

    function store(){
        if(document.getElementById('vendor_id').value==""||document.getElementById('vendor_name').value==""){
            window.alert("Vendor name or Id cannot be empty!");
        }
        else{
            var values = $('#items').val();
            var ven_id = $('#vendor_id').val();
            var ven_name = $('#vendor_name').val();        
            var data = multiDimensionalUnique(bigarray);
            var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('PayVendorController.store')}}",   
                method:"POST",
                data:{values:values,ven_id:ven_id,ven_name:ven_name,data:data,_token:_token}                     
                // success:function(data){        
                // }        
            })
        }
    }

    function multiDimensionalUnique(arr) {   //to remove duplicates in bigarray
        var uniques = [];
        var itemsFound = {};
        for(var i = 0, l = arr.length; i < l; i++) {
            var stringified = JSON.stringify(arr[i]);
            if(itemsFound[stringified]) { continue; }
            uniques.push(arr[i]);
            itemsFound[stringified] = true;
        }
        return uniques;
    }
    function makeTable(){
        var values = $('#items').val();   
        var _token = $('input[name="_token"]').val();
            $.ajax({
                url:"{{ route('PayVendorController.makeTable')}}",   
                method:"POST",
                data:{values:values,_token:_token},                        
                success:function(data){                     
                    $('#table').html(data);                                   
                }        
        })
    }


//  function getdata(vendor_id){
//         console.log('hdfdfdf');
//         var _token = $('input[name="_token"]').val();
//             $.ajax({
//                 url:"{{ route('PayVendorController.getitems')}}",   
//                 method:"POST",
//                 data:{vendor_id:vendor_id,_token:_token},                        
//                 success:function(data){   
//                     $('#vendor_id').val(data);
//                     getdata(document.getElementById('vendor_id').value) ;                     
//                 }        
//             })
//     }
</script>
@endsection