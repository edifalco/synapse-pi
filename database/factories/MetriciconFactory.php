<?php

$factory->define(App\Metricicon::class, function (Faker\Generator $faker) {
    return [
        "metric_id" => $faker->randomNumber(2),
        "icon_id" => $faker->randomNumber(2),
        "project_id" => factory('App\Project')->create(),
    ];
});
