<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Table;
use Faker\Generator as Faker;

$factory->define(Table::class, function (Faker $faker) {
    return [
        'user_id' => 1,
        'name' => $faker->name,
        'position' => $faker->sentence,
        'office' => $faker->country,
        'age' => 1,
        'start_date' => $faker->date('Y-m-d'),
        'salary' => 12000
    ];
});
