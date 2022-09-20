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
        Schema::create('discount_code', function (Blueprint $table) {
            $table->increments('id',10);
            $table->unsignedInteger('type');
            $table->unsignedInteger('discount');
            $table->string('code', 31);
            $table->unsignedInteger('quantity');
            $table->unsignedInteger('start');
            $table->unsignedInteger('end');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('discount_code');
    }
};
