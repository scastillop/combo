@extends('app')
@section('content')
<div>
  <h2>Ingresar Producto</h2>
  <hr>
    {{ Html::ul($errors->all()) }}
    <form method="post" action="{{ route('products.store') }}">
    @csrf
        <div class="form-group">
          <label for="name">Familia</label>
          {!! Form::select('family_id', $families, null, array('class' => 'form-control') ) !!}
        </div>
        <div class="form-group">
          <label for="name">Nombre</label>
          <input type="text" class="form-control" name="name" value="" placeholder="Ingrese Nombre" aria-describedby="nameHelp">    
          <small id="nameHelp" class="form-text text-muted">El nombre del producto debe ser único.</small>
        </div>
        <div class="form-group">
          <label for="name">Descripción</label>
          <input type="text" class="form-control" name="description" value="" placeholder="Ingrese Descripción">    
        </div>
        <div class="form-group">
          <label for="name">Umbral</label>
          <input type="number" class="form-control" name="umbral" value="" placeholder="Ingrese Umbral">    
        </div>
        <div class="form-group">
          <label for="name">Stock</label>
          <input type="number" class="form-control" name="stock" value="" placeholder="Ingrese Stock">    
        </div>
        <div class="form-group">
          <label for="name">Precio</label>
          <input type="number" class="form-control" name="price" value="" placeholder="Ingrese Precio">    
        </div>

        {{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}

    </form>
@endsection
