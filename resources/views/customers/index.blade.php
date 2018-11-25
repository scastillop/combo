@extends('app')
@section('content')
<div>
	<h1>
		Clientes
		<a class="btn btn-xs btn-success" href="{{ URL::to('customers/create') }}">Nuevo Cliente</a>
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
			@foreach ($customers as $customer)
			<tr>
				<td scope="row">{{$customer->name}}</td>
				<td>{{$customer->email}}</td>
				<td>
					<a class="btn btn-small btn-info" href="{{ URL::to('customers/' . $customer->id . '/edit') }}">Editar</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
@endsection
