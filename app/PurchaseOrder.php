<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\PurchaseOrderDetail;
use App\Provider;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_orders';

    public static function generateOrderByUmbral(){
    	$products = \DB::table('products')->where('umbral', '=<', 'stock')->get();
    	$providers = Provider::all();
    	foreach ($products as $product) {
    		$order = new PurchaseOrderDetail;
    		$order->purchase_order_id = $provider->id;
    	}
    	foreach ($providers as $provider) {
    		$order = new PurchaseOrder;
    		$order->provider_id = $provider->id;
    	}
    }
}
