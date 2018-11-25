@extends('app')
@section('content')
<div>
  <h2>Editar Cliente</h2>
  <hr>
  {{ Html::ul($errors->all()) }}
  
  {{ Form::model( $customer, ['route' => ['customers.update', $customer->id], 'method' => 'patch', 'role' => 'form'] ) }}

    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" name="name" value="{{$customer->name}}" placeholder="Ingrese Nombre">    
    </div>
    <div class="form-group">
      <label for="name">Descripción</label>
      <input type="text" class="form-control" name="email" value="{{$customer->email}}" placeholder="Ingrese Email">    
    </div>

    <div class="row">
      <div class="col-md-4"></div>
      <div class="form-group col-md-4">
         {{ Form::submit('Guardar', array('class' => 'btn btn-primary')) }}
      </div>
    </div>
  {{ Form::close() }}
</div>
@endsection
