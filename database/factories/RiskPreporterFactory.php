<?php

$factory->define(App\RiskPreporter::class, function (Faker\Generator $faker) {
    return [
        "partner_id" => factory('App\Partner')->create(),
        "risk_id" => factory('App\Risk')->create(),
    ];
});
