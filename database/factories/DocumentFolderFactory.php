<?php

$factory->define(App\DocumentFolder::class, function (Faker\Generator $faker) {
    return [
        "name" => $faker->name,
    ];
});
