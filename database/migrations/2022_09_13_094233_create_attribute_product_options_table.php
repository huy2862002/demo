<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('attribute_product_options', function (Blueprint $table) {
            $table->increments('id',10);
            $table->unsignedInteger('product_id');
            $table->string('option_id',31);
            $table->string('image', 100);
            $table->unsignedInteger('price');
            $table->unsignedInteger('price_discount');
            $table->unsignedInteger('inventory');
            $table->unsignedInteger('status');
            $table->unsignedInteger('created_at');
            $table->unsignedInteger('updated_at');
        });
    }
    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('attribute_product_options');
    }
};
