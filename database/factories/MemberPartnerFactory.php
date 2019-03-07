<?php

$factory->define(App\MemberPartner::class, function (Faker\Generator $faker) {
    return [
        "member_id" => factory('App\Member')->create(),
        "partner_id" => factory('App\Partner')->create(),
    ];
});
