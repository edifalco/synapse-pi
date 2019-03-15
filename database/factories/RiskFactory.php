<?php

$factory->define(App\Risk::class, function (Faker\Generator $faker) {
    return [
        "project_id" => factory('App\Project')->create(),
        "code" => $faker->name,
        "version" => $faker->randomNumber(2),
        "flag" => 0,
        "resolved" => 0,
        "type_id" => factory('App\RiskType')->create(),
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "title" => $faker->name,
        "description" => $faker->name,
        "trigger_events" => $faker->name,
        "impact_id" => factory('App\RiskImpact')->create(),
        "probability_id" => factory('App\RiskProbability')->create(),
        "proximity_id" => factory('App\RiskProximity')->create(),
        "score" => $faker->randomNumber(2),
        "mitigation" => $faker->name,
        "owner_id" => factory('App\Member')->create(),
        "notes" => $faker->name,
        "contingency" => $faker->name,
        "version_date" => $faker->date("H:i:s", $max = 'now'),
        "parent_id" => $faker->randomNumber(2),
    ];
});
