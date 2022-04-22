<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePlaceOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('place_orders', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('user_id')->length(11);
            $table->bigInteger('product_id')->length(11);
            $table->string('company_name');
            $table->string('email');
            $table->string('payment_method');
            $table->string('grand_total');

        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('place_orders');
    }
}
