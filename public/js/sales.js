$( document ).ready(function() {
	$('#search').on('keyup',function(){
	 
		var value=$(this).val();
		$.ajax({
			headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},		 
			type : 'POST',		 
			url : window.location+'/products/search',		 
			data:{search_by: 'name', search: value},		 
			success:function(products){
				$("#products_catalog").empty();
				products.forEach(function(product) {
					$('#products_catalog').append('<tr><td>'+product.code+'</td><td>'+product.name+'</td><td>'+product.description+'</td><td>'+product.price+'</td><td>'+product.stock+'</td><td><button class="btn btn-xs btn-success" onclick="return addProduct('+product.id+')" >Agregar</button></td></tr>');
				});
			}
		});
	});
});
function addProduct(product_id){
	var row_count = Math.floor((Math.random() * 100) + 1);
	$.ajax({
		headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},		 
		type : 'POST',		 
		url : window.location+'/products/search',		 
		data:{search_by: 'id', search: product_id},		 
		success:function(product){
			$('#products_cart').append('<tr id="tr_'+product.id+'" data-number="'+row_count+'"><td><input type="hidden" id="product_price_'+row_count+'" value="'+product.price+'"/><input name="product_id['+row_count+']" id="product_id_'+product.id+'" value="'+product.id+'" type="hidden" />'+product.code+'</td><td>'+product.name+'</td><td>'+product.description+'</td><td>'+product.price+'</td><td><button type="button" class="btn btn-xs btn-danger" onclick="return deleteProduct('+product.id+')" >Eliminar</button></td></tr>');
			calculateTotals();
		}
	});
}
function deleteProduct(product_id){
	$('#tr_'+product_id).remove();
	calculateTotals();
	return false;
}
function search_by_date(){
	var date_from = $('#date_from').val();
	var date_to = $('#date_to').val();
	location.href = window.location+'?date_from='+date_from+'&date_to='+date_to;
}
function calculateTotals(){
	var total_products = $('#products_cart tr').length;
	var total_price = 0;
	$('input[id^=product_price_]').each(function() {
	  total_price+=parseInt($( this ).val());
	});
	$('#q_products').text(total_products);
	$('#total_price').text('$'+total_price);
}
