<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Address;
use Faker\Generator as Faker;

$factory->define(Address::class, function (Faker $faker) {
    return [
        'street_name' => $faker->streetName,
        'street_number' => $faker->streetAddress,
        'home_number' => $faker->numberBetween(1, 100),
        'city' => $faker->city,
        'state' => $faker->state,
        'post_code' => $faker->postcode,
        'full_address' => $faker->address,
        'country_id' => $faker->numberBetween(1, 100),
    ];
});
