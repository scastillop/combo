@extends('app')
@section('content')
<div>
	<h1>
		Detalle Venta
		<a class="btn btn-xs btn-success" href="{{ URL::to('sales/') }}">Volver</a>
	</h1>
	<hr>
	<br>
	<div class="row">
		<div class="col-md-6">
			<b>Cliente:</b> {{$sale->customer->name}}
		</div>
		<div class="col-md-6">
			<b>Fecha Creación:</b> {{$sale->created_at}}
		</div>
		<div class="col-md-6">
			<b>Método de Pago:</b> {{$sale->payment_method->name}}
		</div>
		<div class="col-md-6">
			<b>Precio Total:</b> ${{$sale->total_amount}}
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
			@foreach ($sale->sale_details as $sale_detail)
			<tr>
				<td scope="row">{{$sale_detail->product_code}}</td>
				<td>{{$sale_detail->product_detail}}</td>
				<td>${{$sale_detail->price}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
