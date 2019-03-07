<?php

$factory->define(App\Schedule::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "description" => $faker->name,
        "status" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "highlight" => $faker->randomNumber(2),
    ];
});
