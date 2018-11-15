<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $table = 'sales';

    public static function getSales(){
        $sales = \DB::table('sales')->get();
        return $sales;
     }
}
