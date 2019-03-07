<?php

$factory->define(App\DeliverableDocument::class, function (Faker\Generator $faker) {
    return [
        "deliverable_id" => factory('App\Deliverable')->create(),
        "document_id" => factory('App\Document')->create(),
    ];
});
