<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCartsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('carts', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->length(11);
            $table->string('product_name');
            $table->string('product_author');
            $table->bigInteger('add_to_cart_id')->length(11);
            $table->bigInteger('quantity')->length(11)->default('1');
            $table->string('product_category');
            $table->string('product_image');
            $table->string('product_price');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('carts');
    }
}
