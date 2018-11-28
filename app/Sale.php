<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use App\SaleDetail;
use App\Customer;
use App\Product;
use Carbon\Carbon;

class Sale extends Model
{
    protected $table = 'sales';

    public static function saveSale(Sale $sale, array $products){
      $total_amount=0;
      $details = array();
      foreach ($products as $product) {
          $sale_detail = new SaleDetail();
          $sale_detail->product_code = $product->code;
          $sale_detail->product_detail = $product->name;
          $sale_detail->price = $product->price;
          array_push($details, $sale_detail);
          $total_amount+=$product->price;
      }
      $sale->total_amount=$total_amount;
      $sale->save();
      foreach ($details as $detail) {
        $detail->sale_id = $sale->id;
        $detail->save();
        Product::reduceStockByCode($detail->product_code);
      }
    }

    public function customer(){
      return $this->belongsTo('App\Customer');
    }

    public static function getByDate($date_from, $date_to){
      if ($date_from == '' && $date_to == ''){
        $sales = Sale::all();
      } else {
        $date_from = $date_from == '' ? Carbon::now() : $date_from;
        $date_to = $date_to == '' ? Carbon::now() : $date_to;
        $sales = Sale::whereBetween('created_at', [$date_from, $date_to])->get();
      }
      return $sales;
    }
}
