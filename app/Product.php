<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Family;
use App\PurchaseOrder;

class Product extends Model
{
    protected $table = 'products';

    // funcion para preguntar si un producto tiene stock disponible
    public static function hasStock($product_id, $quantity){
     	$has_stock = true;
		$product = \DB::table('products')->where('id', $product_id)->first();
		if($product->stock < $quantity){
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

    public static function getByParam($param_key, $value){
        if ($param_key=='name'){
            $products = \DB::table('products')
            ->where('stock', '>', 0)
            ->where('name', 'LIKE' , '%'.$value."%")->get();
             return $products;
        }elseif ($param_key=='id') {
            return Product::find($value);
        }
        
    }

    public static function reduceStockByCode(string $product_code, $quantity = 1){
        $product = Product::where('code', '=', $product_code)->first();
        $product->stock = $product->stock - $quantity;
        $product->save();
        if($product->stock <= $product->umbral){
            PurchaseOrder::generateOrderByUmbral($product);
        }
    }

    public function family(){
      return $this->belongsTo('App\Family');
    }
}
