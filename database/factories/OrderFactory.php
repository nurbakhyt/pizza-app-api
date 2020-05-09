<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Order;
use Faker\Generator as Faker;

$factory->define(Order::class, function (Faker $faker) {
    return [
        'username' => $faker->name,
        'phone' => $faker->phoneNumber,
        'address' => $faker->address,
        'delivery_cost' => 5,
    ];
});
