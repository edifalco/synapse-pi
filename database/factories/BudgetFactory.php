<?php

$factory->define(App\Budget::class, function (Faker\Generator $faker) {
    return [
        "partner_id" => factory('App\Partner')->create(),
        "value" => $faker->randomFloat(2, 1, 100),
        "period" => $faker->randomNumber(2),
        "project_id" => factory('App\Project')->create(),
    ];
});
