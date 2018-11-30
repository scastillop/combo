@extends('app')
@section('content')
<div>
  <h2>Producto menos vendido + Producto más vendido</h2>
  <hr>
  <div class="row">
    <div class="col-md-8">
    <table class="table table-responsive">
      <thead>
        <tr>
          <th scope="col"></th>
          <th scope="col">Código</th>
          <th scope="col">Nombre</th>
          <th scope="col">Descripción</th>
          <th scope="col">Stock</th>
          <th scope="col">Precio</th>
          <th scope="col">Vendidos</th>
        </tr>
      </thead>
      <tbody>
        
        <tr>
          <td scope="row"><b>Producto Menos Vendido</b></td>
          <td >{{$most_and_least_sold_products[0]["least"]->code}}</td>
          <td>{{$most_and_least_sold_products[0]["least"]->name}}</td>
          <td>{{$most_and_least_sold_products[0]["least"]->description}}</td>
          <td>{{$most_and_least_sold_products[0]["least"]->stock}}</td>
          <td>${{$most_and_least_sold_products[0]["least"]->price}}</td>
          <td>{{$most_and_least_sold_products[0]["total_sold"]}}</td>
        </tr>
        <tr>
          <td scope="row"><b>Producto Más Vendido</b></td>
          <td>{{$most_and_least_sold_products[1]["most"]->code}}</td>
          <td>{{$most_and_least_sold_products[1]["most"]->name}}</td>
          <td>{{$most_and_least_sold_products[1]["most"]->description}}</td>
          <td>{{$most_and_least_sold_products[1]["most"]->stock}}</td>
          <td>${{$most_and_least_sold_products[1]["most"]->price}}</td>
          <td>{{$most_and_least_sold_products[1]["total_sold"]}}</td>
        </tr>   
      </tbody>
    </table>
  </div>
  <div class="col-md-4">
    <h2 class="text-center">Total <br><b id="text_total_price">$100000</b></h2>
  </div>
  </div>
  <hr>
    {{ Html::ul($errors->all()) }}
    <form method="post" action="{{ route('promos.store') }}">
@csrf
        <div class="form-group">
          <label for="name">Título</label>
          <input type="text" class="form-control" name="name" value="" placeholder="Ingrese Nombre" aria-describedby="nameHelp">    
        </div>
        <div class="form-group">
          <label for="name">Descripción</label>
          <input type="text" class="form-control" name="description" value="" placeholder="Ingrese Descripción">    
        </div>
        <div class="form-group">
          <label for="name">% Descuento</label>
          <input type="number" class="form-control" name="total_discount" value="" placeholder="Ingrese Descripción">    
        </div>
        <div class="form-group">
          <label for="name">Stock</label>
          <input type="number" class="form-control" name="total_discount" value="" placeholder="Ingrese Descripción">    
        </div>
        <div class="form-group">
          <input type="hidden" class="form-control" name="total_discount" value="">    
        </div>

        {{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}

    </form>
@endsection
