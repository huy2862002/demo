<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->increments('id', 10);
            $table->string('user_name', 30);
            $table->string('phone_number', 15);
            $table->string('email', 31);
            $table->unsignedInteger('region_id');
            $table->unsignedInteger('province_id');
            $table->unsignedInteger('district_id');
            $table->string('address', 50);
            $table->unsignedInteger('status');
            $table->unsignedInteger('total_money');
            $table->unsignedInteger('discount_id');
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
        Schema::dropIfExists('orders');
    }
};
