@extends('app')
@section('content')
<div>
	<h1>
		VENTAS
		<a class="btn btn-xs btn-success" href="{{ URL::to('sales/create') }}">Nueva Venta</a>
	</h1>
	<hr>
	<div class="row">
		<div class="col-md-5">
			<label for="date_from">Fecha desde</label>
			<input type="text" class="form-control datepicker" name="date_from" id="date_from" value="{{$date_from}}"/>
		</div>
		<div class="col-md-5">
			<label for="date_to">Fecha hasta</label>
			<input type="text" class="form-control datepicker" name="date_to" id="date_to" value="{{$date_to}}" />
		</div>
		<div class="col-md-2">
			<button class="btn btn-xs btn-primary" id="search_by_date" onclick="search_by_date();">Buscar</button>
		</div>
	</div>
	<br>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Vendedor</th>
				<th scope="col">Cliente</th>
				<th scope="col">Precio Total</th>
				<th scope="col">Fecha de venta</th>
				<th scope="col"></th>
			</tr>
		</thead>
		<tbody>
			@foreach ($sales as $sale)
			<tr>
				<td scope="row">{{$sale->id}}</td>
				<td>{{$sale->user->name}}</td>
				<td>{{$sale->customer->name}}</td>
				<td>${{$sale->total_amount}}</td>
				<td>{{$sale->created_at}}</td>
				<td><a class="btn btn-xs btn-primary" href="{{ URL::to('sales/' . $sale->id) }}">Ver detalle</a></td>
			</tr>
			@endforeach
		</tbody>
	</table>
</div>
@endsection
