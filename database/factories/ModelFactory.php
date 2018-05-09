<?php

use App\User;
use App\Course;
use App\UserCourse;
use App\Prerequisite;
use Faker\Generator as Faker;

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| This directory should contain each of the model factory definitions for
| your application. Factories provide a convenient way to generate new
| model instances for testing / seeding your application's database.
|
*/

$factory->define(User::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
    ];
});

$factory->define(Course::class, function (Faker $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(Prerequisite::class, function (Faker $faker) {
    return [
        'course_id' => factory(Course::class)->create(),
        'pre_course_id' => factory(Course::class)->create(),
    ];
});

$factory->define(UserCourse::class, function (Faker $faker) {
    return [
        'user_id' => factory(User::class)->create(),
        'course_id' => factory(Course::class)->create(),
    ];
});