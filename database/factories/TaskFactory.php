<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Model;
use App\Project;
use Faker\Generator as Faker;

$factory->define(App\Task::class, function (Faker $faker) {
    return [
        'body' => $faker->sentence,
//        'project_id' => function () {
//            return factory(\App\Project::class)->create()->id;
//        }
        // Deerh function iig laravel-d daraah baidlaar hyalbarchildag.
        'project_id' => factory(Project::class)
    ];
});