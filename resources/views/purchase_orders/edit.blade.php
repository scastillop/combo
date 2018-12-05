@extends('app')
@section('content')
<div>
	<h1>
		Editar Órden de Compra {{$purchase->id}}
		<a class="btn btn-xs btn-success" href="{{ URL::to('purchase_orders/') }}">Volver</a>
	</h1>
	<hr>
	<br>
	<h2>Productos </h2>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th scope="col">Código</th>
				<th scope="col">Producto</th>
				<th scope="col">Detalle</th>
				<th scope="col">Precio</th>
				<th scope="col">Cantidad solicitada</th>
			</tr>
		</thead>
		<tbody>
			<tr>
				<td scope="row">{{$purchase_detail->product_code}}</td>
				<td>{{$purchase_detail->name}}</td>
				<td>{{$purchase_detail->description}}</td>
				<td>${{$purchase_detail->price}}</td>
				<td>{{$purchase_detail->quantity}}</td>
			</tr>
		</tbody>
	</table>

	{{ Html::ul($errors->all()) }}
	  {{ Form::model($purchase, array('route' => array('purchase_orders.update', $purchase->id), 'method' => 'PUT')) }}

	    <div class="form-group">
	      <label for="name">Estado Órden</label>
	      {!! Form::select('status', $statuses, null, array('class' => 'form-control') ) !!}
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
