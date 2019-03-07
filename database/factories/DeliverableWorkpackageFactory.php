<?php

$factory->define(App\DeliverableWorkpackage::class, function (Faker\Generator $faker) {
    return [
        "deliverable_id" => factory('App\Deliverable')->create(),
        "workpackage_id" => factory('App\Workpackage')->create(),
    ];
});
