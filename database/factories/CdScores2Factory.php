<?php

$factory->define(App\CdScores2::class, function (Faker\Generator $faker) {
    return [
        "month" => $faker->randomNumber(2),
        "value" => $faker->randomNumber(2),
        "project_id" => factory('App\Project')->create(),
    ];
});
