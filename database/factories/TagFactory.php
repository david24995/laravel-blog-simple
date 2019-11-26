<?php

/** @var \Illuminate\Database\Eloquent\Factory $factory */

use App\Tag;
use Faker\Generator as Faker;

$factory->define(Tag::class, function (Faker $faker) {

    $title = $faker->unique()->word(5);

    return [
        'name' => $title,
        'slug' => Str::slug($title),
    ];
});
