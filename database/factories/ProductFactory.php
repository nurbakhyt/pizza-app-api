<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Product;
use Faker\Generator as Faker;

$factory->define(Product::class, function (Faker $faker) {
    return [
        'name' => $faker->sentence(4, false),
        'price' => $faker->randomFloat(2, 3, 10),
        'description' => $faker->sentence(12, false),
    ];
});
