<?php

$factory->define(App\Schedule::class, function (Faker\Generator $faker) {
    return [
        "description" => $faker->name,
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "project_id" => factory('App\Project')->create(),
        "status_id" => factory('App\ScheduleStatus')->create(),
        "highlight_id" => factory('App\ScheduleHighlight')->create(),
    ];
});
