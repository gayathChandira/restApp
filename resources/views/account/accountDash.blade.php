@extends('accountant')
@section('content')

{{-- price List table --}}
<div class="card mb-5">        
    <div class="card-body">
        <h1 class="card-title mt-3">Price List</h1>
        <table id="pricetable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
            <thead>
                <tr>
                <th class="th-lg">Dish ID
                </th>
                <th class="th-lg">Dish Name
                </th>
                <th class="th-lg">Unit Price
                </th>
                <th class="th-lg">Price Updated
                </th>                                     
                </tr>
            </thead>
            <tbody>
                @foreach($dishes as $dish)
                <tr>
                    <td> {{$dish->dish_id}} </td>
                    <td> {{$dish->dish_name}} </td>
                    <td> {{$dish->unit_price}} </td>
                    <td> {{$dish->updated_at}} </td>                                            
                </tr>
                @endforeach
            </tbody>            
        </table>
    </div>
</div>     


{{-- income table --}}    
<div class="card mb-5">        
    <div class="card-body">
        <h1 class="card-title mt-3">Income Table <span id="weekstartselect"></span> to <span id="weekendselect"></span></h1>
        <div class="dropdown">        
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1-1" data-toggle="dropdown">Select Week</button>                   
            <div class="dropdown-menu dropdown-primary" id="your-custom-id">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                @foreach($weeks as $week)
                    <a class="dropdown-item mdb-dropdownLink-1" id="selected" href="#" onclick="weeklytablemake('{{$week['start']}}','{{$week['end']}}')">{{$week['start']}} to {{$week['end']}} </a>
                @endforeach                       
            </div>
        </div>  
        <div id="weektabledata"></div> 
        <div class="tohide1">    
            <table id="weeklytable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-lg">Dish ID
                    </th>
                    <th class="th-lg">Food Item Name
                    </th>                           
                    <th class="th-lg">Net Price
                    </th>                                         
                    </tr>
                </thead>
                <tbody>{{ csrf_field() }}  
                    @foreach($weeklytable as $weekly)
                    <tr>
                        <td> {{$weekly->dish_id}} </td>
                        <td> {{$weekly->dish_name}} </td>   
                        <td> {{$weekly->totalPrice}} </td>                                          
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Dish ID</th>
                        <th>Food Item Name</th>                             
                        <th>Net Price</th>                                            
                    </tr>
                </tfoot>
            </table>
        </div>            
    </div>
</div>

{{-- expenses table --}}    
<div class="card mb-5">        
    <div class="card-body">
        <h1 class="card-title mt-3">Expenses Table <span id="weekstartselect"></span> to <span id="weekendselect"></span></h1>
        <div class="dropdown">        
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1-1" data-toggle="dropdown">Select Week</button>                   
            <div class="dropdown-menu dropdown-primary" id="your-custom-id">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                @foreach($weeks as $week)
                    <a class="dropdown-item mdb-dropdownLink-1" id="selected" href="#" onclick="weeklytablemake('{{$week['start']}}','{{$week['end']}}')">{{$week['start']}} to {{$week['end']}} </a>
                @endforeach                       
            </div>
        </div>  
        <div id="weektabledata"></div> 
        <div class="tohide1">    
            <table id="weeklytable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-lg">Item ID
                    </th>
                    <th class="th-lg">Item Name
                    </th>                           
                    <th class="th-lg">Price
                    </th>                                         
                    </tr>
                </thead>
                <tbody>{{ csrf_field() }}  
                    @foreach($weeklytable as $weekly)
                    <tr>
                        <td> {{$weekly->dish_id}} </td>
                        <td> {{$weekly->dish_name}} </td>   
                        <td> {{$weekly->totalPrice}} </td>                                          
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                        <th>Item ID</th>
                        <th>Item Name</th>                             
                        <th>Price</th>                                            
                    </tr>
                </tfoot>
            </table>
        </div>            
    </div>

</div>

<script>

</div>     

{{-- expense table --}}    
<div class="card mb-5">        
    <div class="card-body">
        <h1 class="card-title mt-3">Expense Table <span id="weekstartselect"></span> to <span id="weekendselect"></span></h1>

        <div class="dropdown">        
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1-1" data-toggle="dropdown">Select Week</button>                   
            <div class="dropdown-menu dropdown-primary" id="your-custom-id">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                @foreach($weeks as $week)
                    <a class="dropdown-item mdb-dropdownLink-1" id="selected" href="#" onclick="weeklytablemake('{{$week['start']}}','{{$week['end']}}')">{{$week['start']}} to {{$week['end']}} </a>
                @endforeach                       
            </div>
        </div>  
        <div id="weektabledata"></div> 
        <div class="tohide1">    
            <table id="weeklytable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-lg">Vendor ID
                    </th>
                    <th class="th-lg">Vendor Name
                    </th>                            
                    <th class="th-lg">Food Item
                    </th> 
                    <th class="th-lg">Unit Price
                    </th> 
                    <th class="th-lg"># Of Units
                    </th> 
                    <th class="th-lg">Total Expense
                    </th> 
                                                            
                    </tr>
                </thead>
                <tbody>{{ csrf_field() }}  
                    @foreach($expensetable as $index => $expense)
                    <tr>
                        <td> {{$expense->vendor_id}} </td>
                        <td> {{$expense->vendor_name}} </td>
                     
                        <td> {{$expense->foodItem}} </td>   
                        <td> {{$expense->foodItem}} </td> 
                        <td> {{$expense->foodItem}} </td>  
                        <td> {{$expense->foodItem}} </td>                                      
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                    <th>Dish ID
                    </th>
                    <th>Food Item Name
                    </th>                           
                   
                    <th>Net Price
                    </th>                                            
                    </tr>
                </tfoot>
            </table>
        </div>            

    </div>
</div>     
 <script>

   $(document).ready(function () {
        // pricetable
        $('#pricetable').dataTable({
            "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            "iDisplayLength": 5
        });
        $('#pricetable_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#pricetable_wrapper .dataTables_filter').find('input').each(function () {
            $('input').attr("placeholder", "Search");
            $('input').removeClass('form-control-sm');
        });
        $('#pricetable_wrapper .dataTables_length').addClass('d-flex flex-row');
        $('#pricetable_wrapper .dataTables_filter').addClass('md-form');
        $('#pricetable_wrapper select').removeClass(
            'custom-select custom-select-sm form-control form-control-sm');
        $('#pricetable_wrapper select').addClass('mdb-select');
        $('#pricetable_wrapper .mdb-select').material_select();
        $('#pricetable_wrapper .dataTables_filter').find('label').remove();
//-------------------------------------------------------------------------------------------------------------------
        // incometable
        $('#weeklytable').dataTable({
            "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            "iDisplayLength": 5
        });
        $('#weeklytable_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#weeklytable_wrapper .dataTables_filter').find('input').each(function () {
            $('input').attr("placeholder", "Search");
            $('input').removeClass('form-control-sm');
        });
        $('#weeklytable_wrapper .dataTables_length').addClass('d-flex flex-row');
        $('#weeklytable_wrapper .dataTables_filter').addClass('md-form');
        $('#weeklytable_wrapper select').removeClass(
            'custom-select custom-select-sm form-control form-control-sm');
        $('#weeklytable_wrapper select').addClass('mdb-select');
        $('#weeklytable_wrapper .mdb-select').material_select();
        $('#weeklytable_wrapper .dataTables_filter').find('label').remove();


   }); 

   // weeklytable ajax
   function weeklytablemake(start, end){                                     
     
     var _token = $('input[name="_token"]').val();
     $.ajax({
         url:"{{ route('DashboardController.weektable')}}",    
         method:"POST",
         data:{ start:start,end:end, _token:_token},
         success:function(data){  
             $('.tohide1').fadeOut();           
             $('#weektabledata').html(data);         
             $('#weekstartselect').html(document.getElementById('startdate').value );
             $('#weekendselect').html(document.getElementById('enddate').value);
            //weekly table
             $('#weeklytable').dataTable({
                 "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                 "iDisplayLength": 5
             });
             $('#weeklytable_wrapper').find('label').each(function () {
                 $(this).parent().append($(this).children());
             });
             $('#weeklytable_wrapper .dataTables_filter').find('input').each(function () {
                 $('input').attr("placeholder", "Search");
                 $('input').removeClass('form-control-sm');
             });
             $('#weeklytable_wrapper .dataTables_length').addClass('d-flex flex-row');
             $('#weeklytable_wrapper .dataTables_filter').addClass('md-form');
             $('#weeklytable_wrapper select').removeClass(
                 'custom-select custom-select-sm form-control form-control-sm');
             $('#weeklytable_wrapper select').addClass('mdb-select');
             $('#weeklytable_wrapper .mdb-select').material_select();
             $('#weeklytable_wrapper .dataTables_filter').find('label').remove();

         }           
     })
     
 }    
   
 </script>     
@endsection