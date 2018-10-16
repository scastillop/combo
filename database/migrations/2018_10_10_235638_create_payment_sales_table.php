<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePaymentSalesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payment_sales', function (Blueprint $table) {
            $table->increments('id');
            $table->integer('payment_method_id')->unsigned()->after('id');
            $table->foreign('payment_method_id')->references('id')->on('payment_method');
            $table->string('transaction_code');
            $table->decimal('paid_amount', 8, 2);
            $table->enum('status', ['pending', 'done', 'rejected']);
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
        Schema::dropIfExists('payment_sales');
    }
}
