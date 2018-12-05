@extends('app')
@section('content')
<div>
  <h2>Editar Producto</h2>
  <hr>
  {{ Html::ul($errors->all()) }}
  
  {{ Form::model( $product, ['route' => ['products.update', $product->id], 'method' => 'patch', 'role' => 'form'] ) }}

    <div class="form-group">
      <label for="name">Familia</label>
      {!! Form::select('family_id', $families, null, array('class' => 'form-control') ) !!}
    </div>
    <div class="form-group">
      <label for="name">Nombre</label>
      <input type="text" class="form-control" name="name" value="{{$product->name}}" placeholder="Ingrese Nombre" aria-describedby="nameHelp">    
      <small id="nameHelp" class="form-text text-muted">El nombre del producto debe ser único.</small>
    </div>
    <div class="form-group">
      <label for="name">Descripción</label>
      <input type="text" class="form-control" name="description" value="{{$product->description}}" placeholder="Ingrese Descripción">    
    </div>
    <div class="form-group">
      <label for="name">Umbral</label>
      <input type="number" class="form-control" name="umbral" value="{{$product->umbral}}" placeholder="Ingrese Umbral">    
    </div>
    <div class="form-group">
      <label for="name">Stock</label>
      <input type="number" class="form-control" name="stock" value="{{$product->stock}}" placeholder="Ingrese Stock">  
    </div>
     <div class="form-group">
          <label for="name">Stock Inicial</label>
          <input type="number" class="form-control" name="init_stock" value="{{$product->init_stock}}" placeholder="Ingrese Stock Inicial (útil para generar ordenes de compra)">    
        </div>
    <div class="form-group">
      <label for="name">Precio</label>
      <input type="number" class="form-control" name="price" value="{{$product->price}}" placeholder="Ingrese Precio">    
    </div>
    <div class="form-group">
      <label for="name">Disponible</label>
      {{ Form::radio('available', 1, $product->available==1) }} Si
      {{ Form::radio('available', 0, $product->available==0) }} No
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
