@extends('app')
@section('content')
<div>

  <div class="panel panel-default">
    <div class="panel-heading">
      <h3>Catálogo de Productos </h3>
    </div>
    <div class="panel-body">
      <div class="form-group">
        <input type="text" class="form-control" id="search" name="search" placeholder="Buscar por nombre"></input>
      </div>
      <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Product Name</th>
            <th>Description</th>
            <th>Price</th>
            <th></th>       
          </tr>
        </thead>
        <tbody id="products_catalog">
        </tbody>
      </table>
    </div>
  </div>

  <hr>

  <h2>Ingresar Venta</h2>
  <hr>
    {{ Html::ul($errors->all()) }}
    <form method="post" action="{{ route('customers.store') }}">
    @csrf
        <div class="form-group">
          <label for="name">Cliente</label>
          {!! Form::select('customer_id', $customers, null, array('class' => 'form-control') ) !!}
        </div>
        <div class="form-group">
          <label for="name">Método de Pago</label>
          {!! Form::select('payment_method_id', $payment_methods, null, array('class' => 'form-control') ) !!}
        </div>
        <table class="table table-bordered table-hover">
        <thead>
          <tr>
            <th>ID</th>
            <th>Nombre</th>
            <th>Descripción</th>
            <th>Precio</th>
            <th></th>       
          </tr>
        </thead>
        <tbody id="products_cart">
        </tbody>
      </table>
        {{ Form::submit('Crear', array('class' => 'btn btn-primary')) }}

    </form>


@endsection
