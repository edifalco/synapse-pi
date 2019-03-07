<?php

$factory->define(App\Agenda::class, function (Faker\Generator $faker) {
    return [
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "hour" => $faker->name,
        "minute" => $faker->name,
        "title" => $faker->name,
        "description" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "category" => $faker->name,
        "duration" => $faker->name,
        "meeting_type" => $faker->name,
        "date_creation" => $faker->name,
    ];
});
