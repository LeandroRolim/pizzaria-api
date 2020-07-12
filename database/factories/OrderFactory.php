<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Models\Order\Address;
use App\Models\Order\Order;
use Faker\Generator as Faker;


$factory->define(Order::class, function (Faker $faker) {
    return [
        'user_uid' => $faker->uuid,
        'comments' => $faker->text,
        'order_address_id' => Address::inRandomOrder()->first() ?? factory(Address::class)->create(),
    ];
});
