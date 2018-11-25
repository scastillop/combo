@extends('app')
@section('content')
<div>
  <h2>Ingresar Proveedor</h2>
  <hr>
    {{ Html::ul($errors->all()) }}
    <form method="post" action="{{ route('providers.store') }}">
    @csrf
        <div class="form-group">
          <label for="name">Nombre</label>
          <input type="text" class="form-control" name="business_name" value="" placeholder="Ingrese Nombre">    
        </div>
        <div class="form-group">
          <label for="name">Dirección</label>
          <input type="text" class="form-control" name="address" value="" placeholder="Ingrese Dirección">
        </div>

        {{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}

    </form>
@endsection
