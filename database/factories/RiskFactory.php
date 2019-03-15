<?php

$factory->define(App\Risk::class, function (Faker\Generator $faker) {
    return [
        "project_id" => factory('App\Project')->create(),
        "code" => $faker->name,
        "version" => $faker->randomNumber(2),
        "flag" => 0,
        "resolved" => 0,
        "risks_type_id" => factory('App\RiskType')->create(),
        "risk_date" => $faker->date("d-m-Y", $max = 'now'),
        "title" => $faker->name,
        "description" => $faker->name,
        "trigger_events" => $faker->name,
        "risk_impact_id" => factory('App\RiskImpact')->create(),
        "risk_probabilities_id" => factory('App\RiskProbability')->create(),
        "score" => $faker->randomNumber(2),
        "risk_proximity_id" => factory('App\RiskProximity')->create(),
        "mitigation" => $faker->name,
        "notes" => $faker->name,
        "contingency" => $faker->name,
        "version_date" => $faker->date("H:i:s", $max = 'now'),
        "parent_id" => $faker->randomNumber(2),
    ];
});
