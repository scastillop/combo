<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePromoDetailsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('promo_details', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('promo_id')->unsigned();
            $table->foreign('promo_id')->references('id')->on('promos');
            $table->string('product_code');
            $table->string('product_name');
            $table->decimal('product_price', 8, 2);
            $table->decimal('product_discount', 8, 2);
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
        Schema::dropIfExists('promo_details');
    }
}
