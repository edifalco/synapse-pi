<?php

$factory->define(App\RiskMreporter::class, function (Faker\Generator $faker) {
    return [
        "member_id" => factory('App\Member')->create(),
        "risk_id" => factory('App\Risk')->create(),
    ];
});
