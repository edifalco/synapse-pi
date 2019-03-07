<?php

$factory->define(App\Risk::class, function (Faker\Generator $faker) {
    return [
        "code" => $faker->name,
        "version" => $faker->randomNumber(2),
        "parent_id" => $faker->randomNumber(2),
        "description" => $faker->name,
        "score" => $faker->randomNumber(2),
        "flag" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "impact" => $faker->randomNumber(2),
        "probability" => $faker->randomNumber(2),
        "proximity" => $faker->name,
        "title" => $faker->name,
        "contingency" => $faker->name,
        "mitigation" => $faker->name,
        "triggerevents" => $faker->name,
        "resolved" => $faker->randomNumber(2),
        "risk_date" => $faker->date("d-m-Y", $max = 'now'),
        "version_date" => $faker->date("H:i:s", $max = 'now'),
        "type" => $faker->randomNumber(2),
        "notes" => $faker->name,
    ];
});
