<?php

$factory->define(App\ProjectPeriod::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->name,
        "period_num" => $faker->name,
        "project_id" => factory('App\Project')->create(),
    ];
});
