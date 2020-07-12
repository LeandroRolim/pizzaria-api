<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order\Address;
use Faker\Generator as Faker;


$factory->define(Address::class, function (Faker $faker) {
    return [
        'street' => $faker->streetName,
        'number' => $faker->numerify('####'),
        'district' => $faker->word,
        'city' => $faker->city,
        'zip_code' => $faker->numerify('########'),
    ];
});
