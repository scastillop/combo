<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Promo extends Model
{
	protected $table = 'promos';

	//funcion para traer todos los productos menos vendidos en un rango de fecha pero que al menos tengan 1 venta
	public static function getMostSelledProducts(string $date_from, string $date_to){
		$response = \DB::table('sales')
						->leftJoin('sale_details', 'sales.id', '=', 'sale_details.sale_id')
						->whereBetween('sales.created_at', array($date_from, $date_to))
						->select(\DB::raw('count(`sale_details`.`product_code`) as total_selled, `sale_details`.`product_code`'))
						->groupBy('sale_details.product_code')
						->orderBy('total_selled', 'asc')
						->limit(10)
						->get();
		return $response;
	}

	public static function getMostAndLeastSoldProduct($date_from, $date_to){

		$response = array();
		$less_selled_product = \DB::table('products')
								->leftJoin('sale_details', 'sale_details.product_code', '=', 'products.code')
								->whereBetween('sale_details.created_at', array($date_from, $date_to))
								->select(\DB::raw('count(`sale_details`.`product_code`) as total_sold, `products`.`code`'))
								->groupBy('products.code')
								->orderBy('total_sold', 'asc')
								->limit(1)
								->first();
		$most_selled_product = \DB::table('products')
								->leftJoin('sale_details', 'sale_details.product_code', '=', 'products.code')
								->whereBetween('sale_details.created_at', array($date_from, $date_to))
								->select(\DB::raw('count(`sale_details`.`product_code`) as total_sold, `products`.`code`'))
								->groupBy('products.code')
								->orderBy('total_sold', 'desc')
								->limit(1)
								->first();
		if(isset($less_selled_product)){
			array_push($response, ['least'=>Product::where('code','=',$less_selled_product->code)->first(), 'total_sold'=>$less_selled_product->total_sold]);
		}
		if(isset($most_selled_product)){
		array_push($response, ['most'=>Product::where('code','=',$most_selled_product->code)->first(), 'total_sold'=>$most_selled_product->total_sold]);
		}
		return $response;
	}

	//funcion para guardar un combo oferton,  desde el controlador creamos el objeto promo y mandamos el array de productos retornado por algun criterio
	/*Parameters*/
	//objeto Promo
	//array Productos
	public static function savePromo(Promo $promo, array $products){
		$total_price = 0;
		$details = array();
		foreach ($products as $product) {
			$price = $product->price * ((100 - $promo->total_discount)/100);
		    $promo_detail = new PromoDetail;
		    $promo_detail->promo_id = $promo->id;
		    $promo_detail->product_code = $product->code;
		    $promo_detail->product_name = $product->name;
		    $promo_detail->product_price = $price;
		    $promo_detail->product_discount = $promo->total_discount;
		    $total_price += $price;
		    array_push($details, $promo_detail);
		}
		$promo->total_price = $total_price;
		$promo->save();
		foreach ($details as $detail) {
			$detail->promo_id = $promo->id;
			$detail->save();
			Product::reduceStockByCode($detail->product_code, $promo->stock);
		}
		return true;
		
	}

	//minimo 2 productos en el criterio, el mas vendido y el menos vendido
	// ingresar % descuento
}
