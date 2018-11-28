@extends('app')
@section('content')
<div>
	<h1>
		Productos
		<a class="btn btn-xs btn-success" href="{{ URL::to('products/create') }}">Nuevo Producto</a>
	</h1>
	<hr>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th scope="col">Código</th>
				<th scope="col">Familia</th>
				<th scope="col">Nombre</th>
				<th scope="col">Descripción</th>
				<th scope="col">Precio</th>
				<th scope="col">Umbral</th>
				<th scope="col">Stock</th>
				<th scope="col">Disponible</th>
				<th scope="col">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($products as $product)
			<tr>
				<td scope="row">{{$product->code}}</td>
				<td>{{$product->family->name}}</td>
				<td>{{$product->name}}</td>
				<td>{{$product->description}}</td>
				<td>${{$product->price}}</td>
				<td>{{$product->umbral}}</td>
				<td>{{$product->stock}}</td>
				<td>{{ $product->available == 1 ? 'Si' : 'No' }}</td>
				<td>
					<a class="btn btn-small btn-info" href="{{ URL::to('products/' . $product->id . '/edit') }}">Editar</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
@endsection
