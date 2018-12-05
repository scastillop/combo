@extends('app')
@section('content')
<div>
	<h1>COMBOS OFERTON</h1>
	<hr>
	<br>
	<div>
		<h2>Producto menos vendido + Producto más vendido</h2>
		<div class="row">
			<div class="col-md-5">
				<label for="date_from">Fecha desde</label>
				<input type="text" class="form-control datepicker" name="date_from" id="date_from" value="{{$date_from}}" />
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
				<?php if(isset($most_and_least_sold_products[0])){ ?>
				<tr>
					<td scope="row"><b>Producto Menos Vendido</b></td>
					<td >{{$most_and_least_sold_products[0]["least"]->code}}</td>
					<td>{{$most_and_least_sold_products[0]["least"]->name}}</td>
					<td>{{$most_and_least_sold_products[0]["least"]->description}}</td>
					<td>{{$most_and_least_sold_products[0]["least"]->stock}}</td>
					<td>${{$most_and_least_sold_products[0]["least"]->price}}</td>
					<td>{{$most_and_least_sold_products[0]["total_sold"]}}</td>
				</tr>
				<?php } ?>
				<?php if(isset($most_and_least_sold_products[1])){ ?>
				<tr>
					<td scope="row"><b>Producto Más Vendido</b></td>
					<td>{{$most_and_least_sold_products[1]["most"]->code}}</td>
					<td>{{$most_and_least_sold_products[1]["most"]->name}}</td>
					<td>{{$most_and_least_sold_products[1]["most"]->description}}</td>
					<td>{{$most_and_least_sold_products[1]["most"]->stock}}</td>
					<td>${{$most_and_least_sold_products[1]["most"]->price}}</td>
					<td>{{$most_and_least_sold_products[1]["total_sold"]}}</td>
				</tr>	
				<?php } ?>	
			</tbody>
		</table>
		<a class="btn btn-xs btn-success" href="{{ URL::to('promos/create?promo_type=most_and_least_sold_products&date_from='. $date_from .'&date_to='.$date_to.'') }}">Generar Combo</a>
	</div>
	<br>
	<hr>
	<div>
		<h2>Combos Anteriores</h2>
		<table class="table table-responsive">
			<thead>
				<tr>
					<th scope="col">ID</th>
					<th scope="col">Nombre</th>
					<th scope="col">Descripción</th>
					<th scope="col">Stock</th>
					<th scope="col">Fecha Creación</th>
					<th scope="col">% Descuento</th>
					<th scope="col">Precio Total</th>
				</tr>
			</thead>
			<tbody>
				@foreach ($promos as $promo)
				<tr>
					<td scope="row">{{$promo->id}}</td>
					<td>{{$promo->name}}</td>
					<td>{{$promo->description}}</td>
					<td>{{$promo->stock}}</td>
					<td>{{$promo->created_at}}</td>
					<td>{{$promo->total_discount}}%</td>
					<td>${{$promo->total_price}}</td>
					<td><a class="btn btn-xs btn-primary" href="{{ URL::to('promos/' . $promo->id) }}">Ver detalle</a></td>
				</tr>
				@endforeach
			</tbody>
		</table>
	</div>
</div>
@endsection
