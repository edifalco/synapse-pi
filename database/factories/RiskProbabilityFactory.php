<?php

$factory->define(App\RiskProbability::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
