<?php

$factory->define(App\DeliverableReviewer::class, function (Faker\Generator $faker) {
    return [
        "deliverable_id" => factory('App\Deliverable')->create(),
        "member_id" => factory('App\Member')->create(),
    ];
});
