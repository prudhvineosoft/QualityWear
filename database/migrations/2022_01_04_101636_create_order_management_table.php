<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrderManagementTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('order_management', function (Blueprint $table) {
            $table->id();
            $table->string('user_id');
            $table->bigInteger('order_id');
            $table->bigInteger('product_id');
            $table->string('payment_method');
            $table->bigInteger('address_id');
            $table->string('coupon_code')->nullable();
            $table->string('o_status')->nullable();
            $table->bigInteger('order_total')->nullable();
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
        Schema::dropIfExists('order_management');
    }
}
