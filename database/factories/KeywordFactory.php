<?php

$factory->define(App\Keyword::class, function (Faker\Generator $faker) {
    return [
        "word" => $faker->name,
    ];
});
