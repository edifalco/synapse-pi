<?php

$factory->define(App\DeliverableStatus::class, function (Faker\Generator $faker) {
    return [
        "label" => $faker->name,
    ];
});
