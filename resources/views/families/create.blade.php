@extends('app')
@section('content')
<div>
  <h2>Ingresar Familia</h2>
  <hr>
    {{ Html::ul($errors->all()) }}
    <form method="post" action="{{ route('families.store') }}">
@csrf
        <div class="form-group">
          <label for="name">Nombre</label>
          <input type="text" class="form-control" name="name" value="" placeholder="Ingrese Nombre" aria-describedby="nameHelp">    
          <small id="nameHelp" class="form-text text-muted">El nombre de la familia debe ser único.</small>
        </div>
        <div class="form-group">
          <label for="name">Descripción</label>
          <input type="text" class="form-control" name="description" value="" placeholder="Ingrese Descripción">    
        </div>

        {{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}

    </form>
@endsection
