<div>
	<h1>INDEX VENTAS</h1>
	<table>
		<thead>
			<tr>
				<th>ID</th>
				<th>Cliente</th>
				<th>monto</th>
			</tr>
		</thead>
		<tbody>
			@foreach ($sales as $sale)
			<tr>
				<td>{{$sale->id}}</td>
				<td>{{$sale->customer_id}}</td>
				<td>${{$sale->total_amount}}</td>
			</tr>
			@endforeach
		</tbody>
	</table>
	
	<?php echo e($sales) ?>
</div>