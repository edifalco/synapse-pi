<?php

$factory->define(App\Partnerrole::class, function (Faker\Generator $faker) {
    return [
        "partner_id" => factory('App\Partner')->create(),
        "role_id" => $faker->randomNumber(2),
        "project_id" => factory('App\Project')->create(),
    ];
});
