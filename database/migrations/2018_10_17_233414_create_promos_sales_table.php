<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromosSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promos_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('promo_id')->unsigned();
            $table->foreign('promo_id')->references('id')->on('promos');
            $table->integer('sale_id')->unsigned();
            $table->foreign('sale_id')->references('id')->on('sales');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('promos_sales');
    }
}
