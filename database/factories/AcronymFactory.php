<?php

$factory->define(App\Acronym::class, function (Faker\Generator $faker) {
    return [
        "acronym" => $faker->name,
        "partner_id" => factory('App\Partner')->create(),
    ];
});
