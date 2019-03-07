<?php

$factory->define(App\Partnernum::class, function (Faker\Generator $faker) {
    return [
        "value" => $faker->randomNumber(2),
        "partner_id" => factory('App\Partner')->create(),
        "project_id" => factory('App\Project')->create(),
    ];
});
