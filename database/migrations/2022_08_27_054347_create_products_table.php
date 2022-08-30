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
            $table->unsignedInteger('category_id');
            $table->string('avatar',100);
            $table->unsignedInteger('price');
            $table->unsignedInteger('discount');
            $table->unsignedInteger('status');
            $table->unsignedInteger('view');
            $table->string('moTaNgan',300);
            $table->string('moTaSP', 2000);
            $table->unsignedInteger('ngayTao');
            $table->unsignedInteger('ngayCapNhat');
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
