@extends('app')
@section('content')
<div>
  <h2>Ingresar Cliente</h2>
  <hr>
    {{ Html::ul($errors->all()) }}
    <form method="post" action="{{ route('customers.store') }}">
    @csrf
        <div class="form-group">
          <label for="name">Nombre</label>
          <input type="text" class="form-control" name="name" value="" placeholder="Ingrese Nombre">    
        </div>
        <div class="form-group">
          <label for="name">Email</label>
          <input type="text" class="form-control" name="email" value="" placeholder="Ingrese Email">
        </div>

        {{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}

    </form>
@endsection
