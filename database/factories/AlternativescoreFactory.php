<?php

$factory->define(App\Alternativescore::class, function (Faker\Generator $faker) {
    return [
        "show" => $faker->randomNumber(2),
        "project_id" => factory('App\Project')->create(),
    ];
});
