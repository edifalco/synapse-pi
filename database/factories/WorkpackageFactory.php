<?php

$factory->define(App\Workpackage::class, function (Faker\Generator $faker) {
    return [
        "wp_id" => $faker->name,
        "name" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "order" => $faker->randomNumber(2),
    ];
});
