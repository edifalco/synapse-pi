<?php

$factory->define(App\Document::class, function (Faker\Generator $faker) {
    return [
        "title" => $faker->name,
        "folder" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "deliverable_id" => factory('App\Deliverable')->create(),
    ];
});
