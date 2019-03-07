<?php

$factory->define(App\ProjectUser::class, function (Faker\Generator $faker) {
    return [
        "userID_id" => factory('App\User')->create(),
        "projectID_id" => factory('App\Project')->create(),
    ];
});
