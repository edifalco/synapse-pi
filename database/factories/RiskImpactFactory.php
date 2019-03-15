<?php

$factory->define(App\RiskImpact::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
