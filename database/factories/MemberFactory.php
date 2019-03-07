<?php

$factory->define(App\Member::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "surname" => $faker->name,
        "partner_id" => factory('App\Partner')->create(),
        "email" => $faker->name,
        "phone" => $faker->name,
        "notes" => $faker->name,
    ];
});
