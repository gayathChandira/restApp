@extends('inventoryMgr')

@section('content')
    <h1>Add New Food Item</h1>
    {!! Form::open(['action'=> 'FoodItemController@storenew', 'method' =>'POST'])!!}
        <div class="form-group mt-5">
            {{Form::label('foodItem', 'Food Item Name')}}
            {{Form::text('foodItem', '', ['class' =>'form-control', 'placeholder'=>'Food Item Name'])}}
        </div>   
       
        <div class="form-group">
                {{Form::label('unit', 'Unit')}}
                {{Form::text('unit', '', ['class' =>'form-control', 'placeholder'=>'Unit Name'])}}
        </div>    
        <div class="form-group">
                {{Form::label('limit', 'Food-Item Limit')}}
                {{Form::text('limit', '', ['class' =>'form-control', 'placeholder'=>'Food Item Limit'])}}
        </div> 
        {{Form::submit('Submit', ['class' => 'btn btn-primary'])}} 
    {!! Form::close() !!}
@endsection