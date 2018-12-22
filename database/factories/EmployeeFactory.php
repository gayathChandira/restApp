<?php

use Faker\Generator as Faker;


$factory->define(App\Employee::class, function (Faker $faker) {
    return [
        'fname' => $faker->firstName, 
        'lname' => $faker->lastName, 
        'age' => $faker->numberBetween(20,65), 
        'contact' => $faker->numberBetween(710000000,789999999),
        'email' => $faker->unique()->safeEmail
    ];
});
