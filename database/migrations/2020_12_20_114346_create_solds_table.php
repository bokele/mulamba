<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSoldsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('solds', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("car_id");
            $table->unsignedBigInteger("owner_id");
            $table->unsignedBigInteger("customer_id");
            $table->unsignedBigInteger("car_model_id");
            $table->unsignedBigInteger("price");
            $table->unsignedBigInteger("sold_price");
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
        Schema::dropIfExists('solds');
    }
}
