@extends('admin')

@section('content')

{{-- <div class="row">
    <div class="col-md-4" style="background-color: green;margin:3%">
fdf
    </div>
    <div class="col-md-4" style="background-color: darkslateblue">
fdf
    </div>
    <div class="col-md-4" style="background-color:darkviolet">
dfd
    </div>

</div>
<div class="row">
    <div class="col-md-6" style="background-color: firebrick">
fd
    </div>
    <div class="col-md-6" style="background-color:goldenrod">
fdf
    </div>
</div>


 --}}



    {{-- employee table --}}
    <div class="card mb-5">        
        <div class="card-body">
            <h1 class="card-title mt-3">Current Employees</h1>
            <table id="emptable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-lg">First Name
                    </th>
                    <th class="th-lg">Last Name
                    </th>
                    <th class="th-lg">Age
                    </th>
                    <th class="th-lg">Contact
                    </th>
                    <th class="th-lg">Email
                    </th>                      
                    </tr>
                </thead>
                <tbody>
                    @foreach($employee as $emp)
                    <tr>
                        <td> {{$emp->fname}} </td>
                        <td> {{$emp->lname}} </td>
                        <td> {{$emp->age}} </td>
                        <td> {{$emp->contact}} </td>
                        <td> {{$emp->email}} </td>                            
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                    <th>First Name
                    </th>
                    <th>Last Name
                    </th>
                    <th>Age
                    </th>
                    <th>Contact
                    </th>
                    <th>Email
                    </th>                        
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>    

    {{-- vendors table --}}
    <div class="card mb-5">        
        <div class="card-body">
            <h1 class="card-title mt-3">Current Vendors</h1>

            <table id="ventable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-lg">First Name
                    </th>
                    <th class="th-lg">Last Name
                    </th>                           
                    <th class="th-lg">Contact
                    </th>
                    <th class="th-lg">Email
                    </th>                      
                    </tr>
                </thead>
                <tbody>
                    @foreach($vendor as $ven)
                    <tr>
                        <td> {{$ven->fname}} </td>
                        <td> {{$ven->lname}} </td>                                
                        <td> {{$ven->contact}} </td>
                        <td> {{$ven->email}} </td>                            
                    </tr>
                    @endforeach
                </tbody>
                <tfoot>
                    <tr>
                    <th>First Name
                    </th>
                    <th>Last Name
                    </th>                           
                    <th>Contact
                    </th>
                    <th>Email
                    </th>                        
                    </tr>
                </tfoot>
            </table>
        </div>
    </div>    

    {{-- Income Variation through Past Week --}}
    <div class="card mb-5">        
        <div class="card-body">
            <h1 class="mb-5">Income Variation through Past Week</h1>
            <canvas id="myChart" style="max-width: 500px;"></canvas>
        </div>
    </div>      

    {{-- day table --}}
    <div class="card mb-5">        
            <div class="card-body">
            <h1 class="card-title mt-3">Food Items purchased on <span class="tohide">Today</span><span id="dateselect"></span></h1>                
        <div class="dropdown">        
            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1-1" data-toggle="dropdown">Select Date</button>                   
            <div class="dropdown-menu dropdown-primary" id="dateSearch">
                <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                @foreach($billdates as $dates)
                    <a class="dropdown-item mdb-dropdownLink-1" id="selected" href="#" onclick="daytablemake('{{$dates->day}}')">{{$dates->day}}</a>
                @endforeach                       
            </div>
        </div>   
            <div id="daytabledata"></div>
            <div class="tohide" >
                <table id="daytable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
                    <thead>
                        <tr>
                        <th class="th-lg">Bill ID
                        </th>
                        <th class="th-lg">Food Item Name
                        </th>                           
                        <th class="th-lg">Quantity
                        </th>
                        <th class="th-lg">Price
                        </th>    
                        <th class="th-lg">Time
                        </th>                  
                        </tr>
                    </thead>  {{ csrf_field() }}  
                    <tbody >                        
                            @foreach($daytable as $day)
                            <tr>
                                <td> {{$day->id}} </td>
                                <td> {{$day->dish_name}} </td>                                
                                <td> {{$day->quantity}} </td>
                                <td> {{$day->price}} </td>    
                                <td> {{explode(" ",$day->created_at)[1]}} </td>                          
                            </tr>
                            @endforeach                   
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>Bill ID
                        </th>
                        <th>Food Item Name
                        </th>                           
                        <th>Quantity
                        </th>
                        <th>Price
                        </th>   
                        <th>Time
                        </th>                      
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>
    </div>    
    

    {{-- weekly monthly summery --}}
    <div class="card mb-5">        
        <div class="card-body">
            <h1 class="card-title mt-3">Weekly /  Monthly Summery <span id="weekstartselect"></span> to <span id="weekendselect"></span></h1>
            <div class="row">
                <div class="col-sm-3">
                    <div class="dropdown">        
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1-1" data-toggle="dropdown">Select Week</button>                   
                        <div class="dropdown-menu dropdown-primary" id="your-custom-id">
                            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                            @foreach($weeks as $week)
                                <a class="dropdown-item mdb-dropdownLink-1" id="selected" href="#" onclick="weeklytablemake('{{$week['start']}}','{{$week['end']}}')">{{$week['start']}} to {{$week['end']}} </a>
                            @endforeach                       
                        </div>
                    </div>  
                </div>
                <div class="col-sm-3">
                    <div class="dropdown">        
                        <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1-1" data-toggle="dropdown">Select Month</button>                   
                        <div class="dropdown-menu dropdown-primary" id="your-custom-id">
                            <input class="form-control" type="text" placeholder="Search" aria-label="Search">
                            @foreach($weeks as $week)
                                <a class="dropdown-item mdb-dropdownLink-1" id="selected" href="#" onclick="weeklytablemake('{{$week['start']}}','{{$week['end']}}')">{{$week['start']}} to {{$week['end']}} </a>
                            @endforeach                       
                        </div>
                    </div>  
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
                        <th class="th-lg">Quantity
                        </th>
                        <th class="th-lg">Net Income
                        </th>                                         
                        </tr>
                    </thead>
                    <tbody>{{ csrf_field() }}  
                        @foreach($weeklytable as $weekly)
                        <tr>
                            <td> {{$weekly->dish_id}} </td>
                            <td> {{$weekly->dish_name}} </td>
                            <td> {{$weekly->totalQuantity}} </td>
                            <td> {{$weekly->totalPrice}} </td>                                          
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <th>Dish ID
                        </th>
                        <th>Food Item Name
                        </th>                           
                        <th>Quantity
                        </th>
                        <th>Net Income
                        </th>                                            
                        </tr>
                    </tfoot>
                </table>
            </div>            

        </div>
    </div>    
    
<script>
 
    $(document).ready(function () {
        // emptable
        $('#emptable').dataTable({
            "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            "iDisplayLength": 5
        });
        $('#emptable_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#emptable_wrapper .dataTables_filter').find('input').each(function () {
            $('input').attr("placeholder", "Search");
            $('input').removeClass('form-control-sm');
        });
        $('#emptable_wrapper .dataTables_length').addClass('d-flex flex-row');
        $('#emptable_wrapper .dataTables_filter').addClass('md-form');
        $('#emptable_wrapper select').removeClass(
            'custom-select custom-select-sm form-control form-control-sm');
        $('#emptable_wrapper select').addClass('mdb-select');
        $('#emptable_wrapper .mdb-select').material_select();
        $('#emptable_wrapper .dataTables_filter').find('label').remove();

        //ven table
        $('#ventable').dataTable({
            "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            "iDisplayLength": 5
        });
        $('#ventable_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#ventable_wrapper .dataTables_filter').find('input').each(function () {
            $('input').attr("placeholder", "Search");
            $('input').removeClass('form-control-sm');
        });
        $('#ventable_wrapper .dataTables_length').addClass('d-flex flex-row');
        $('#ventable_wrapper .dataTables_filter').addClass('md-form');
        $('#ventable_wrapper select').removeClass(
            'custom-select custom-select-sm form-control form-control-sm');
        $('#ventable_wrapper select').addClass('mdb-select');
        $('#ventable_wrapper .mdb-select').material_select();
        $('#ventable_wrapper .dataTables_filter').find('label').remove();
   
       


        // bar graph
        dates = {!! json_encode($datearray) !!};
        incomes = {!! json_encode($pricearray) !!};
 
        var ctx = document.getElementById("myChart").getContext('2d');
        var myChart = new Chart(ctx, {
            type: 'bar',
            data: {
            labels: dates,          
            datasets: [{
                label: 'Income (Rs)',
                data: incomes,
                backgroundColor: [
                'rgba(255, 99, 132, 0.2)',
                'rgba(54, 162, 235, 0.2)',
                'rgba(255, 159, 64, 0.2)',
                'rgba(255, 206, 86, 0.2)',
                'rgba(75, 192, 192, 0.2)',
                'rgba(153, 102, 255, 0.2)',
                'rgba(255, 159, 64, 0.2)'
                ],
                borderColor: [
                'rgba(255,99,132,1)',
                'rgba(54, 162, 235, 1)',
                'rgba(255, 159, 64, 1)',
                'rgba(255, 206, 86, 1)',
                'rgba(75, 192, 192, 1)',
                'rgba(153, 102, 255, 1)',
                'rgba(255, 159, 64, 1)'
                ],
                borderWidth: 1
            }]
            },
            options: {
            scales: {
                yAxes: [{
                ticks: {
                    beginAtZero: true
                }
                }]
            }
            }
        });


        //Day table
    
        $('#daytable').dataTable({
            "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            "iDisplayLength": 5
        });
        $('#daytable_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#daytable_wrapper .dataTables_filter').find('input').each(function () {
            $('input').attr("placeholder", "Search");
            $('input').removeClass('form-control-sm');
        });
        $('#daytable_wrapper .dataTables_length').addClass('d-flex flex-row');
        $('#daytable_wrapper .dataTables_filter').addClass('md-form');
        $('#daytable_wrapper select').removeClass(
            'custom-select custom-select-sm form-control form-control-sm');
        $('#daytable_wrapper select').addClass('mdb-select');
        $('#daytable_wrapper .mdb-select').material_select();
        $('#daytable_wrapper .dataTables_filter').find('label').remove();

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

        
        

    });

    // daytable ajax
    function daytablemake(date){                                     
        console.log(date);
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ route('DashboardController.daytable')}}",    
            method:"POST",
            data:{ date:date, _token:_token},
            success:function(data){  
                $('.tohide').fadeOut();           
                $('#daytabledata').html(data);         
                $('#dateselect').html(document.getElementById('date').value);
               
               //Day table
                $('#daytable').dataTable({
                    "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
                    "iDisplayLength": 5
                });
                $('#daytable_wrapper').find('label').each(function () {
                    $(this).parent().append($(this).children());
                });
                $('#daytable_wrapper .dataTables_filter').find('input').each(function () {
                    $('input').attr("placeholder", "Search");
                    $('input').removeClass('form-control-sm');
                });
                $('#daytable_wrapper .dataTables_length').addClass('d-flex flex-row');
                $('#daytable_wrapper .dataTables_filter').addClass('md-form');
                $('#daytable_wrapper select').removeClass(
                    'custom-select custom-select-sm form-control form-control-sm');
                $('#daytable_wrapper select').addClass('mdb-select');
                $('#daytable_wrapper .mdb-select').material_select();
                $('#daytable_wrapper .dataTables_filter').find('label').remove();
            }           
        })
        
    } 

    // weeklytable ajax
    function weeklytablemake(start, end){                                     
        console.log('fdfd');
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ route('DashboardController.weektable')}}",    
            method:"POST",
            data:{ start:start,end:end, _token:_token},
            dataType: "json",
            success:function(data){  
                // console.log(data.output);
                // console.log(data.weeklytable);

                $('.tohide1').fadeOut();           
                $('#weektabledata').html(data.output);         
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