<?php

$factory->define(App\Team::class, function (Faker\Generator $faker) {
    return [
        "member_id" => factory('App\Member')->create(),
        "project_id" => factory('App\Project')->create(),
        "role" => $faker->name,
        "partner_id" => factory('App\Partner')->create(),
    ];
});
