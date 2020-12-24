<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreatePaymentsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('payments', function (Blueprint $table) {
            $table->id();
            $table->string('ref_number');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('order_id');
            $table->string('currency')->nullable();
            $table->unsignedBigInteger('sold_price');
            $table->unsignedBigInteger('amount');
            $table->boolean('confirm')->default(false);
            $table->string('payment_method')->nullable();
            $table->string('payment_code')->nullable();
            $table->string('payment_time')->nullable();
            $table->string('status')->nullable();
            $table->string('method')->nullable();
            $table->string('type')->nullable(); // car_sold, car_rental, home_sold, proprty_sold
            $table->timestamps();
            $table->softDeletes();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('payments');
    }
}
