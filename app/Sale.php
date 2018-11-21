<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SaleDetail;

class Sale extends Model
{
    protected $table = 'sales';

    public static function getSales(){
        $sales = \DB::table('sales')->get();
        return $sales;
     }
    //
    public static function saveSale(Sale $sale, array $products){
      $sale->save();
      $total_amount=0;
      foreach ($products as $product) {
          $sale_detail = new SaleDetail();
          $sale_detail->sale_id = $sale->id;
          $sale_detail->product_code = $product->code;
          $sale_detail->product_detail = $product->name;
          $sale_detail->price = $product->price;
          $sale_detail->save();
          $total_amount+=$product->price;
      }
      $sale->total_amount=$total_amount;
      $sale->save();
    }
}
