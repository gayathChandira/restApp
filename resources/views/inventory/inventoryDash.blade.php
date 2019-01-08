@extends('inventoryMgr')
@section('content')


    {{-- today issued food item table --}}
    <div class="card mb-5">        
        <div class="card-body">
            <h1 class="card-title mt-3">Today Issued Food Ingredients</h1>
            <table id="issuetable" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
                <thead>
                    <tr>
                    <th class="th-lg">Issue Id 
                    </th>
                    <th class="th-lg">Ingredient Name
                    </th>
                    <th class="th-lg">Quantity
                    </th>
                    <th class="th-lg">Issued Time
                    </th>
                    <th class="th-lg">Issued By
                    </th>                                        
                    </tr>
                </thead>
                <tbody>
                    @foreach($issuetable as $issue)
                    <tr>
                        <td> {{$issue->id}} </td>
                        <td> {{$issue->food_item}} </td>
                        <td> {{$issue->quantity}} </td>
                        <td> {{explode(" ",$issue->created_at)[1]}} </td>
                        <td> {{Auth::user()->fname}} </td>                                                  
                    </tr>
                    @endforeach
                </tbody>
                
            </table>
        </div>
    </div>    

     {{-- all issued item table --}}
     <div class="card mb-5">        
            <div class="card-body">
                <h1 class="card-title mt-3">All Issued Items</h1>
    
                <table id="allissue" class="table table-striped table-responsive-sm" cellspacing="0" width="100%">
                    <thead>
                    <tr>
                    <th class="th-lg">Issue Id 
                    </th>
                    <th class="th-lg">Ingredient Name
                    </th>
                    <th class="th-lg">Quantity
                    </th>
                    <th class="th-lg">Issued Date & Time
                    </th>
                    <th class="th-lg">Issued By
                    </th>                                        
                    </tr>
                    </thead>
                    <tbody>
                        @foreach($allissue as $all)
                        <tr>
                            <td> {{$all->id}} </td>
                            <td> {{$all->food_item}} </td>                                
                            <td> {{$all->quantity}} </td>
                            <td> {{$all->created_at}} </td>     
                            <td> {{Auth::user()->fname}} </td>                           
                        </tr>
                        @endforeach
                    </tbody>
                    <tfoot>
                        <tr>
                        <th class="th-lg">Issue Id 
                        </th>
                        <th class="th-lg">Ingredient Name
                        </th>
                        <th class="th-lg">Quantity
                        </th>
                        <th class="th-lg">Issued Time
                        </th>
                        <th class="th-lg">Issued By
                        </th>                                
                        </tr>
                    </tfoot>
                </table>
            </div>
        </div>    


        {{-- line chart --}}
        <div class="card mb-5">        
            <div class="card-body">
                <h1 class="card-title mt-3">Food Item's Inventory Levels</h1>
        {{-- <div class="dropdown">        
                <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenu1-1" data-toggle="dropdown">Select Ingredient</button>                   
                <div class="dropdown-menu dropdown-primary" id="your-custom-id">
                    <input class="form-control" type="text"  placeholder="Search" aria-label="Search">
                    @foreach($itemNames as $item)
                        <a class="dropdown-item mdb-dropdownLink-1" id="selected" href="#" onclick="">{{$item->itemName}} </a>
                    @endforeach                       
                </div>
            </div>   --}}
            <div class="form-group">    
                <label for="users">Select Ingredient </label>
                <select name="id" id="users" class="form-control dropdown-menu dropdown-primary" onchange="selectedItem()">
                    @foreach($itemNames as $item)
                    <option class="dropdown-item mdb-dropdownLink-1" value="{{$item->itemName}}">{{$item->itemName}}</option>
                    @endforeach
                </select>
            </div>{{ csrf_field() }}  
            <canvas id="lineChart"></canvas>
        </div>
    </div>
    <script>

    $(document).ready(function () {

        // all issue food item table
        $('#allissue').dataTable({
            "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
            "iDisplayLength": 5
        });
        $('#allissue_wrapper').find('label').each(function () {
            $(this).parent().append($(this).children());
        });
        $('#allissue_wrapper .dataTables_filter').find('input').each(function () {
            $('input').attr("placeholder", "Search");
            $('input').removeClass('form-control-sm');
        });
        $('#allissue_wrapper .dataTables_length').addClass('d-flex flex-row');
        $('#allissue_wrapper .dataTables_filter').addClass('md-form');
        $('#allissue_wrapper select').removeClass(
            'custom-select custom-select-sm form-control form-control-sm');
        $('#allissue_wrapper select').addClass('mdb-select');
        $('#allissue_wrapper .mdb-select').material_select();
        $('#allissue_wrapper .dataTables_filter').find('label').remove();

        //line chart         
        $('#users').select2({
            placeholder : 'Select Item',
            theme: "classic"       
        });
        
        
    
    });
    var quantity;
    var dates;
    function selectedItem(){
        var selected = document.getElementById("users").value;
        console.log(selected);
        var _token = $('input[name="_token"]').val();
        $.ajax({
            url:"{{ route('DashboardController.linegraph')}}",    
            method:"POST",
            data:{ selected:selected, _token:_token},
            success:function(data){ 
            console.log(data.quantity);    
            quantity = data.quantity;
            dates = data.dates;

            var ctxL = document.getElementById("lineChart").getContext('2d');
            var myLineChart = new Chart(ctxL, {
            type: 'line',
            data: {
            labels: dates,
            datasets: [{
                label: "My First dataset",
                data: quantity,
                backgroundColor: [
                    'rgba(105, 0, 132, .2)',
                ],
                borderColor: [
                    'rgba(200, 99, 132, .7)',
                ],
                borderWidth: 2
                }
            ]
            },
            options: {
            responsive: true
            }
        });       
            }
        })    
    }
    
    </script>
@endsection