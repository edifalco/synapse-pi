<?php

$factory->define(App\ThresholdDeliverable::class, function (Faker\Generator $faker) {
    return [
        "value" => $faker->randomNumber(2),
        "project_id" => factory('App\Project')->create(),
    ];
});
