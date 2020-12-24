<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Car;
use Faker\Generator as Faker;

$factory->define(Car::class, function (Faker $faker) {
    return [
        'car_model_id' => $faker->numberBetween(1, 10),
        'owner_id' => $faker->numberBetween(1, 1),
        'address_id' => $faker->numberBetween(1, 10),
        'mileage' => $faker->numberBetween(999, 1000000),
        'vehicle_fuel_type' => $faker->vehicleFuelType,
        'vehicle_seat_count' => $faker->vehicleSeatCount,
        'vehicle_gear_box_type' => $faker->vehicleGearBoxType,
        'vehicle_door_count' => $faker->vehicleDoorCount,
        'vehicle_registration' => $faker->vehicleRegistration('[A-Z]{2}-[0-9]{5}'),
        'Vehicle_identification_number' => $faker->vin,
        'color' => $faker->hexColor(),
        'status' => $faker->randomElement(array('sold', 'rental', 'remove', 'buy')),
        'description_of_feature' => $faker->paragraph(10)
    ];
});
