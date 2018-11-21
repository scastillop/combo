<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $table = 'products';

    // funcion para preguntar si un producto tiene stock disponible
    public static function hasStock($product_id){
     	$has_stock = true;
		$product = \DB::table('products')->where('id', $product_id)->first();
		if($product->stock < 1){
			$has_stock = false;
		}
		return $has_stock;
    }

    // funcion para guardar un producto
    public static function saveProduct(Product $product){
    	$product->code=0;
        $product->save();
        $product->generateCode();
    	return $product;
    }

    // funcion para generar el codigo de un producto
    public function generateCode(){
        $this->code = (string)sprintf("%04d", $this->family_id).(string)sprintf("%04d", $this->id).substr($this->name, 0, 5);
        $this->save();
    }
}
