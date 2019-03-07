<?php

$factory->define(App\Effort::class, function (Faker\Generator $faker) {
    return [
        "project_id" => factory('App\Project')->create(),
        "workpackage_id" => factory('App\Workpackage')->create(),
        "partner_id" => factory('App\Partner')->create(),
        "value" => $faker->randomNumber(2),
        "period" => $faker->randomNumber(2),
    ];
});
