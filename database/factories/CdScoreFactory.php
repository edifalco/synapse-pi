<?php

$factory->define(App\CdScore::class, function (Faker\Generator $faker) {
    return [
        "month" => $faker->randomNumber(2),
        "value" => $faker->randomFloat(2, 1, 100),
        "project_id" => factory('App\Project')->create(),
    ];
});
