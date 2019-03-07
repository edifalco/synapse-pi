<?php

$factory->define(App\DocumentFavorite::class, function (Faker\Generator $faker) {
    return [
        "document_id" => factory('App\Document')->create(),
        "project_id" => factory('App\Project')->create(),
    ];
});
