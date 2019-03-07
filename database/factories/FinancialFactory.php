<?php

$factory->define(App\Financial::class, function (Faker\Generator $faker) {
    return [
        "document" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "title" => $faker->name,
    ];
});
