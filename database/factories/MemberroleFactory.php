<?php

$factory->define(App\Memberrole::class, function (Faker\Generator $faker) {
    return [
        "member_id" => factory('App\Member')->create(),
        "role" => $faker->name,
        "project_id" => factory('App\Project')->create(),
        "partner_id" => factory('App\Partner')->create(),
    ];
});
