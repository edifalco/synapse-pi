<?php

$factory->define(App\Publication::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "year" => $faker->name,
        "month" => $faker->randomNumber(2),
        "abbr" => $faker->name,
        "link" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "authors" => $faker->name,
    ];
});
