<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Message;
use Faker\Generator as Faker;

$factory->define(Message::class, function (Faker $faker) {
    return [
        'from' => $faker->numberBetween(1, 10),
        'to' => $faker->numberBetween(1, 10),
    ];
});
