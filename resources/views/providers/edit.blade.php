@extends('app')
@section('content')
<div>
  <h2>Editar Proveedor</h2>
  <hr>
  {{ Html::ul($errors->all()) }}
  
  {{ Form::model( $provider, ['route' => ['providers.update', $provider->id], 'method' => 'patch', 'role' => 'form'] ) }}

    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" name="business_name" value="{{$provider->business_name}}" placeholder="Ingrese Nombre">    
    </div>
    <div class="form-group">
      <label for="name">Descripción</label>
      <input type="text" class="form-control" name="address" value="{{$provider->address}}" placeholder="Ingrese Dirección">    
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
