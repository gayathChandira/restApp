@extends('pdf.letterhead')

@section('content')
        
{{-- {{ csrf_field() }}   --}}
        {{-- employee table --}}

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
   




<script>
//  $(document).ready(function () {
//         // emptable
//         $('#emptable').dataTable({
//             "aLengthMenu": [[5, 10, 15, -1], [5, 10, 15, "All"]],
//             "iDisplayLength": 5
//         });
//         $('#emptable_wrapper').find('label').each(function () {
//             $(this).parent().append($(this).children());
//         });
//         $('#emptable_wrapper .dataTables_filter').find('input').each(function () {
//             $('input').attr("placeholder", "Search");
//             $('input').removeClass('form-control-sm');
//         });
//         $('#emptable_wrapper .dataTables_length').addClass('d-flex flex-row');
//         $('#emptable_wrapper .dataTables_filter').addClass('md-form');
//         $('#emptable_wrapper select').removeClass(
//             'custom-select custom-select-sm form-control form-control-sm');
//         $('#emptable_wrapper select').addClass('mdb-select');
//         $('#emptable_wrapper .mdb-select').material_select();
//         $('#emptable_wrapper .dataTables_filter').find('label').remove();
// });
</script>

@endsection