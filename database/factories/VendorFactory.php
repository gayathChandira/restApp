<?php

use Faker\Generator as Faker;

$factory->define(App\Vendor::class, function (Faker $faker) {
    return [
        'fname' => $faker->firstName, 
        'lname' => $faker->randomElement(['Grocery', 'Enterprice','Stores','Farm house']),      
        'contact' => $faker->numberBetween(710000000,789999999),
        'email' => $faker->unique()->safeEmail
    ];
});
