@extends('app')
@section('content')
<div>
	<h1>
		Familias
		<a class="btn btn-xs btn-success" href="{{ URL::to('families/create') }}">Nueva Familia</a>
	</h1>
	<hr>
	<table class="table table-responsive">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Nombre</th>
				<th scope="col">Descripción</th>
				<th scope="col">Acciones</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($families as $family)
			<tr>
				<td scope="row">{{$family->id}}</td>
				<td>{{$family->name}}</td>
				<td>{{$family->description}}</td>
				<td>
					<a class="btn btn-small btn-info" href="{{ URL::to('families/' . $family->id . '/edit') }}">Editar</a>
				</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
</div>
@endsection
