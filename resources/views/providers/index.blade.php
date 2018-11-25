@extends('app')
@section('content')
<div>
	<h1>
		Proveedores
		<a class="btn btn-xs btn-success" href="{{ URL::to('providers/create') }}">Nuevo Proveedor</a>
	</h1>
	<hr>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th scope="col">Nombre</th>
				<th scope="col">Email</th>
				<th scope="col">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($providers as $provider)
			<tr>
				<td scope="row">{{$provider->business_name}}</td>
				<td>{{$provider->address}}</td>
				<td>
					<a class="btn btn-small btn-info" href="{{ URL::to('providers/' . $provider->id . '/edit') }}">Editar</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
@endsection
