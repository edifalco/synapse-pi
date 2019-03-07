<?php

$factory->define(App\Partner::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
        "acronym" => $faker->name,
        "image" => $faker->name,
        "country" => $faker->name,
    ];
});
