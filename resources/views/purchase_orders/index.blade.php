@extends('app')
@section('content')
<div>
	<h1>
		Órdenes de Compra
	</h1>
	<hr>
	<br>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Proveedor</th>
				<th scope="col">Dirección proveedor</th>
				<th scope="col">Precio Total</th>
				<th scope="col">Fecha de creación</th><
				<th></th>
				<th></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($purchases as $purchase)
			<tr>
				<td scope="row">{{$purchase->id}}</td>
				<td>{{$purchase->provider->business_name}}</td>
				<td>{{$purchase->provider->address}}</td>
				<td>${{$purchase->total_price}}</td>
				<td>{{$purchase->created_at}}</td>
				<td><a class="btn btn-xs btn-primary" href="{{ URL::to('purchase_orders/' . $purchase->id) }}">Ver detalle</a></td>
				<td>
					<a class="btn btn-xs btn-primary" href="{{ URL::to('purchase_orders/' . $purchase->id . '/edit') }}">Editar</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
