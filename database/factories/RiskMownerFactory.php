<?php

$factory->define(App\RiskMowner::class, function (Faker\Generator $faker) {
    return [
        "member_id" => factory('App\Member')->create(),
        "risk_id" => factory('App\Risk')->create(),
    ];
});
