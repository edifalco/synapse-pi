<?php

$factory->define(App\ProjectMember::class, function (Faker\Generator $faker) {
    return [
        "project_id" => factory('App\Project')->create(),
        "member_id" => factory('App\Member')->create(),
        "partner_id" => factory('App\Partner')->create(),
    ];
});
