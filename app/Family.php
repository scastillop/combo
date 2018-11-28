<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;

class Family extends Model
{
	protected $table = 'families';
    public static function stock_available($family_id){
    	$count = 0;
    	$products = \DB::table('products')->where('family_id', $family_id)->get();
    	foreach ($products as $product) {
    		$count+=$product->stock;
    	}
    	return $count;
    }
}
