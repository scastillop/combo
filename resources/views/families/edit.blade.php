@extends('app')
@section('content')
<div>
  <h2>Editar Familia</h2>
  <hr>
  {{ Html::ul($errors->all()) }}
  {{ Form::model($family, array('route' => array('families.update', $family->id), 'method' => 'PUT')) }}

    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" name="name" value="{{$family->name}}" placeholder="Ingrese Nombre" aria-describedby="nameHelp">    
      <small id="nameHelp" class="form-text text-muted">El nombre de la familia debe ser único.</small>
    </div>
    <div class="form-group">
      <label for="name">Descripción</label>
      <input type="text" class="form-control" name="description" value="{{$family->description}}" placeholder="Ingrese Descripción">    
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
