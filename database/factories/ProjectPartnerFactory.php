<?php

$factory->define(App\ProjectPartner::class, function (Faker\Generator $faker) {
    return [
        "project_id" => factory('App\Project')->create(),
        "partner_id" => factory('App\Partner')->create(),
    ];
});
