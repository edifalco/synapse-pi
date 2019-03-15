<?php

$factory->define(App\RiskType::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
