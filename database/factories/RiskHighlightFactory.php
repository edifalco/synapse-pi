<?php

$factory->define(App\RiskHighlight::class, function (Faker\Generator $faker) {
    return [
        "risk_id" => factory('App\Risk')->create(),
        "project_id" => factory('App\Project')->create(),
    ];
});
