<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use Faker\Generator as Faker;

$factory->define(\App\Table::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->name,
    ];
});
