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
        Schema::create('products', function (Blueprint $table) {
            $table->increments('id',10);
            $table->string('name',30);
            $table->string('slug',50);
            $table->unsignedInteger('category_id');
            $table->string('image',100);
            $table->unsignedInteger('price');
            $table->unsignedInteger('price_discount');
            $table->unsignedInteger('inventory');
            $table->unsignedInteger('view');
            $table->string('short_description',300);
            $table->string('product_description', 2000);
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
        Schema::dropIfExists('products');
    }
};
