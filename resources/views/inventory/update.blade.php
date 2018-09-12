@extends('inventoryMgr')

@section('content')
    <h1>Update Stock</h1>
    {!! Form::open(['action'=> 'FoodItemController@store', 'method' =>'POST'])!!}
        <div class="form-group">
            {{Form::label('foodItem', 'Food Item')}}
            {{Form::text('foodItem', '', ['class' =>'form-control', 'placeholder'=>'Food Item'])}}
        </div>   
        <div class="form-group">
                {{Form::label('quantity', 'Quantity')}}
                {{Form::text('quantity', '', ['class' =>'form-control', 'placeholder'=>'Quantity'])}}
        </div>
        <div class="form-group">
                {{Form::label('vendor', 'Vendor Name')}}
                {{Form::text('vendor', '', ['class' =>'form-control', 'placeholder'=>'Vendor Name'])}}
        </div>    

        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
    {!! Form::close() !!}
@endsection