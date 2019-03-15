<?php

$factory->define(App\ScheduleHighlight::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
