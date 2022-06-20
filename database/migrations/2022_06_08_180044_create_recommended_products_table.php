<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateRecommendedProductsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('recommended_products', function (Blueprint $table) {
            $table->id();
            $table->bigInteger('product_id')->length(11);
            $table->string('username');
            $table->string("title");
            $table->string("author");
            $table->string("photo");
            $table->string("category");
            $table->string("product_description");
            $table->string("product_price");
            $table->bigInteger('category_clicks')->length(11)->default('1');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('recommended_products');
    }
}
