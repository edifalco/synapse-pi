<?php

$factory->define(App\DeliverableMember::class, function (Faker\Generator $faker) {
    return [
        "member_id" => factory('App\Member')->create(),
        "deliverable_id" => factory('App\Deliverable')->create(),
    ];
});
