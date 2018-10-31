<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Promo extends Model
{
	protected $table = 'promos';

	//funcion para traer todos los productos menos vendidos en un rango de fecha pero que al menos tengan 1 venta
	public static function getMostSelledProducts($date_from, $date_to){
		$response = \DB::table('sales')
						->leftJoin('sale_details', 'sales.id', '=', 'sale_details.sale_id')
						->whereBetween('sales.created_at', array($date_from, $date_to))
						->select('sale_details.product_code')
						->select('sale_details.* AS total_selled')->count()
						->group('sale_details.product_code')
						->orderBy('total_selled', 'asc')
						->limit(10)
						->get();
		return $response;
	}

	//funcion para guardar un combo oferton,  desde el controlador creamos el objeto promo y mandamos el array de productos retornado por algun criterio
	/*Parameters*/
	//objeto Promo
	//array Productos
	public static function savePromo(Promo $promo, array $products){
		$promo->save();
		foreach ($products as $product) {
		    $promo_detail = new PromoDetail;
		    $promo_detail->promo_id = $promo->id;
		    $promo_detail->product_code = $product->code;
		    $promo_detail->product_name = $product->name;
		    $promo_detail->product_price = $product->price;
		    $promo_detail->save();
		}
	}
}
