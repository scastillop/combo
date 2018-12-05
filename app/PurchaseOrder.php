<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\Product;
use App\PurchaseOrderDetail;
use App\Provider;

class PurchaseOrder extends Model
{
    protected $table = 'purchase_orders';

    public static function generateOrderByUmbral(Product $product){
    	$providers = Provider::all();
        $pending_orders = \DB::table('purchase_orders')
                    ->leftJoin('purchase_order_details', 'purchase_order_details.purchase_order_id', '=', 'purchase_orders.id')
                    ->where('product_id', $product->id)
                    ->where('status', 'pending')
                    ->get();
        if($pending_orders->count() == 0){
            foreach ($providers as $provider) {
                $order = new PurchaseOrder;
                $order->provider_id = $provider->id;
                $order->total_price = $product->price;
                $order->status = 'pending';
                $order->save();
                $order_detail = new PurchaseOrderDetail;
                $order_detail->purchase_order_id = $order->id;
                $order_detail->name = $product->name;
                $order_detail->description = $product->description;
                $order_detail->price = $product->price;
                $order_detail->quantity = $product->init_stock;
                $order_detail->product_id = $product->id;
                $order_detail->product_code = $product->code;
                $order_detail->save();
            }
        }
        return true;
    }

    public function provider(){
      return $this->belongsTo('App\Provider');
    }
}
