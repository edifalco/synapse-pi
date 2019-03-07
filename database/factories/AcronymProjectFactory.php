<?php

$factory->define(App\AcronymProject::class, function (Faker\Generator $faker) {
    return [
        "acronym_id" => factory('App\Acronym')->create(),
        "partner_id" => factory('App\Partner')->create(),
        "project_id" => factory('App\Project')->create(),
    ];
});
