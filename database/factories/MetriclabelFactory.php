<?php

$factory->define(App\Metriclabel::class, function (Faker\Generator $faker) {
    return [
        "label" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "metric_id" => $faker->randomNumber(2),
    ];
});
