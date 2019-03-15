<?php

$factory->define(App\ScheduleStatus::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
