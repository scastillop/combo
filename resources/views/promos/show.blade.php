@extends('app')
@section('content')
<div>
	<h1>
		Detalle Venta
		<a class="btn btn-xs btn-success" href="{{ URL::to('promos/') }}">Volver</a>
	</h1>
	<hr>
	<br>
	<div class="row">
		<div class="col-md-6">
			<b>Combo:</b> {{$promo->name}}
		</div>
		<div class="col-md-6">
			<b>Descripción:</b> {{$promo->description}}
		</div>
		<div class="col-md-6">
			<b>Stock:</b> {{$promo->stock}}
		</div>
		<div class="col-md-6">
			<b>Fecha Creación:</b> {{$promo->created_at}}
		</div>
		<div class="col-md-6">
			<b>% Descuento:</b> {{$promo->total_discount}}
		</div>
		<div class="col-md-6">
			<b>Precio Total:</b> {{$promo->total_price}}
		</div>
	</div>
	<hr>
	<br>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th scope="col">Código</th>
				<th scope="col">Producto</th>
				<th scope="col">Precio</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($promo_details as $detail)
			<tr>
				<td scope="row">{{$detail->product_code}}</td>
				<td>{{$detail->product_name}}</td>
				<td>${{$detail->product_price}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
