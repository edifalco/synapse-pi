<?php

$factory->define(App\Period::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->randomNumber(2),
        "period_num" => $faker->randomNumber(2),
        "project_id" => factory('App\Project')->create(),
    ];
});
