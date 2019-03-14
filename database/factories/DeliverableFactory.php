<?php

$factory->define(App\Deliverable::class, function (Faker\Generator $faker) {
    return [
        "label_identification" => $faker->name,
        "title" => $faker->name,
        "short_title" => $faker->name,
        "date" => $faker->date("d-m-Y", $max = 'now'),
        "status_id" => factory('App\DeliverableStatus')->create(),
        "notes" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "confidentiality" => $faker->randomNumber(2),
        "submission_date" => $faker->date("d-m-Y", $max = 'now'),
        "due_date_months" => $faker->randomNumber(2),
        "workpackages_id" => factory('App\Workpackage')->create(),
    ];
});
