<?php

$factory->define(App\Financialvisibility::class, function (Faker\Generator $faker) {
    return [
        "type" => $faker->name,
        "status" => $faker->randomNumber(2),
        "id_project_id" => factory('App\Project')->create(),
    ];
});
