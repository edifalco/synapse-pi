<?php

$factory->define(App\DeliverablePartner::class, function (Faker\Generator $faker) {
    return [
        "partner_id" => factory('App\Partner')->create(),
        "deliverable_id" => factory('App\Deliverable')->create(),
    ];
});
