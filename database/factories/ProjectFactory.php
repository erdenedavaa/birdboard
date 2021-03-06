<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Project;
use App\User;
use Faker\Generator as Faker;

$factory->define(Project::class, function (Faker $faker) {
    return [
        'title' => $faker->sentence(4),
        'description' => $faker->sentence(4),
//        'owner_id' => function() {
//            return factory(App\User::class)->create()->id;
//        }
        'notes' => 'Foobar notes',
        'owner_id' => factory(User::class)
    ];
});
