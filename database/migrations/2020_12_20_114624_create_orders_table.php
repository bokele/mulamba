<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateOrdersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            $table->string('code');
            $table->unsignedBigInteger('country_id');
            $table->unsignedBigInteger('message_id');
            $table->unsignedBigInteger('customer_id');
            $table->unsignedBigInteger('owner_id');
            $table->unsignedBigInteger('car_id')->nullable();
            $table->unsignedBigInteger('address_id')->nullable();
            $table->string('status')->default('negotiation');
            $table->double('price');
            $table->double('propose_price');
            $table->double('balance');
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
        Schema::dropIfExists('orders');
    }
}
