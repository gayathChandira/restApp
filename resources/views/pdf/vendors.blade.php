@extends('pdf.letterhead')

@section('content')
{{-- vendors table --}}

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
     

 


@endsection