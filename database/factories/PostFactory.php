<?php

$factory->define(App\Post::class, function (Faker\Generator $faker) {
    return [
        "created" => $faker->date("d-m-Y", $max = 'now'),
        "idUser_id" => factory('App\User')->create(),
        "description" => $faker->name,
        "idProject_id" => factory('App\Project')->create(),
    ];
});
