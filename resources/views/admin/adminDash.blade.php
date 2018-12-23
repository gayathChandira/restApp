@extends('admin')

@section('content')

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

        <div class="card mb-5">        
            <div class="card-body">
                <h1 class="mb-5">Income Variation through Past Week</h1>
                <canvas id="myChart" style="max-width: 500px;"></canvas>
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

    });
</script>

@endsection