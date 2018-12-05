@extends('app')
@section('content')
<div>
	<h1>
		Órden de Compra {{$purchase->id}}
		<a class="btn btn-xs btn-success" href="{{ URL::to('purchase_orders/') }}">Volver</a>
	</h1>
	<hr>
	<br>
	<div class="row">
		<div class="col-md-6">
			Proveedor: {{$purchase->provider->business_name}}
		</div>
		<div class="col-md-6">
			Dirección Proveedor: {{$purchase->provider->address}}
		</div>
		<div class="col-md-6">
			Precio Total: ${{$purchase->total_price}}
		</div>
		<div class="col-md-6">
			Creada en: {{$purchase->created_at}}
		</div>
		<div class="col-md-6">
			Estado: {{$purchase->status}}
		</div>
	</div>
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
</div>
@endsection
