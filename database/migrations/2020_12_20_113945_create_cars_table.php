<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateCarsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('cars', function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("owner_id");
            $table->unsignedBigInteger("car_model_id");
            $table->unsignedBigInteger("price");
            $table->string("currency");
            $table->string("vehicle_fuel_type");
            $table->string("vehicle_seat_count");
            $table->string("vehicle_gear_box_type");
            $table->string("vehicle_door_count");
            $table->string("vehicle_registration")->nullable();
            $table->string("Vehicle_identification_number");
            $table->string("mileage");
            $table->string("color");
            $table->string("status");
            $table->longText("description_of_feature");
            $table->string('white_book');
            $table->string('tax_clearancy')->nullable();
            $table->string('last_insurancy')->nullable();
            $table->string('cover_image')->nullable();
            $table->string('front_car_image')->nullable();
            $table->string('car_left_side')->nullable();
            $table->string('car_right_side')->nullable();
            $table->string('car_behind_image')->nullable();
            $table->string('dashbooard_image')->nullable();
            $table->string('inside_image')->nullable();
            $table->string('pomo_code')->nullable();
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
        Schema::dropIfExists('cars');
    }
}
