<?php

$factory->define(App\Scoredescription::class, function (Faker\Generator $faker) {
    return [
        "description" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "score_id" => $faker->randomNumber(2),
    ];
});
