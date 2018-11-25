@extends('app')
@section('content')
<div>
	<h1>COMBOS OFERTON</h1>
	<hr>
	<div>
		<h2>Productos menos vendidos (con al menos una venta)</h2>
		<table class="table table-responsive">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Cliente</th>
				<th scope="col">monto</th>
			</tr>
		</thead>
			<tbody>
				<tr>
			      <th scope="row">1</th>
			      <td>Mark</td>
			      <td>Otto</td>
			    </tr>
			</tbody>
		</table>
	</div>
	<hr>
	<div>
		<h2>Productos con mayor stock y menos vendidos</h2>
		<table class="table table-responsive">
		<thead>
			<tr>
				<th scope="col">ID</th>
				<th scope="col">Cliente</th>
				<th scope="col">monto</th>
			</tr>
		</thead>
			<tbody>
				<tr>
			      <th scope="row">1</th>
			      <td>Mark</td>
			      <td>Otto</td>
			    </tr>
			</tbody>
		</table>
	</div>
	<?php echo e($promos) ?>
</div>
@endsection
