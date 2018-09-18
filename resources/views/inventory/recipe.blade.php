@extends('inventoryMgr')

@section('content')
    <h1>Make a New Recipe</h1>
    {!! Form::open(['action'=>'RecipeController@store', 'method' =>'POST'])!!}
        <div class="form-group">
            {{Form::label('recipeName', 'Meal Name')}}
            {{Form::text('recipeName', '', ['class' =>'form-control', 'placeholder'=>'Recipe', 'id'=>'item_ID'])}}
            {{-- <input type="text" class="form-control" id="item_ID"> --}}
            <div id="item_list" style="z-index: 1;position:absolute;"></div>            
        </div>
        <div id="room_fileds">
            <div class="form-row">
                <div class="col form-group"  >
                    {{Form::label('ingredients', 'Ingredients')}}
                    {{Form::text('array1[0][0]', '', ['class' =>'form-control', 'placeholder'=>'Recipe'])}}
                                        
                </div> 
                <div class="col form-group ">
                    {{Form::label('amounts', 'Amounts')}}
                    {{Form::text('array1[0][1]', '', ['class' =>'form-control', 'placeholder'=>'Recipe'])}}
                </div> 
            </div>  
        </div>      
        <input type="button" class="btn btn-danger btn-sm btn-rounded" id="more_fields" onclick="add_fields();" value="Add More" />          
         <br><br><br><br><br>
         <input type="hidden" name="loopLength" id="length"/>
        <div style="display:block;">
            {{Form::submit('Submit', ['class' => 'btn btn-default'])}} 
        </div>
        
    {!! Form::close() !!}
     
    <script>
        var room = 0;      
        function add_fields() {
            room++;
            var objTo = document.getElementById('room_fileds')
            var divtest = document.createElement("div");
            divtest.innerHTML = '<div class="form-row"><div class="form-group col"><label>Ingrediants</label><input type ="text" name="array1['+room+'][0]" class="form-control"></div><div class="form-group col"><label>Amounts</label><input type ="text" name="array1['+room+'][1]" class="form-control"></div></div>';
            objTo.appendChild(divtest);
            document.getElementById('length').value = room;
            var hello = document.getElementById("length").value
            console.log(hello);
        }
        
        
      
    </script>
    
@endsection