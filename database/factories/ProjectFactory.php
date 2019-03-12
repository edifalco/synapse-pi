<?php

$factory->define(App\Project::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "description" => $faker->name,
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "duration" => $faker->randomNumber(2),
        "image" => $faker->name,
        "partners_id" => factory('App\Partner')->create(),
    ];
});
