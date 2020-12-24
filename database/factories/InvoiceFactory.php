<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Invoice;
use Faker\Generator as Faker;

$factory->define(Invoice::class, function (Faker $faker) {
    return [
        'ref_number' => $faker->uuid,
        'payment_id' => $faker->numberBetween(1, 10),
        'owner_id' => $faker->numberBetween(1, 10),
        'customer_id' => $faker->numberBetween(1, 10),
        'vat' => $faker->randomElement(array(18, 20, 16)),
        'total_amount_payable' => $faker->randomFloat(200, 30000),
        'discount_amount' => $faker->randomFloat(0, 1000),
        'net_amount_payable' => $faker->randomFloat(200, 30000),
        'platform_amount' => $faker->randomFloat(200, 300),
        'total_amount_pay' => $faker->randomFloat(200, 30000),
        'invoice_for' => $faker->randomElement(array('car sold', 'car reservation', 'car rent',)),
        'status' => $faker->randomElement(array('receive', 'accept', 'cancel', 'pending'))
    ];
});
