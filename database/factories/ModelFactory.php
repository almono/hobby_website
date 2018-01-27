<?php

/*
|--------------------------------------------------------------------------
| Model Factories
|--------------------------------------------------------------------------
|
| Here you may define all of your model factories. Model factories give
| you a convenient way to create models for testing and seeding your
| database. Just tell the factory how a default model should look.
|
*/

/** @var \Illuminate\Database\Eloquent\Factory $factory */
$factory->define(App\User::class, function (Faker\Generator $faker) {
    static $password;

    return [
        'username' => $faker->unique()->lastName,
        'first_name' => $faker->firstNameMale,
        'last_name' => $faker->lastName,
        'role_id' => function() {
            return factory(App\Role::class)->create()->id;
        },
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\ClassMain::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->unique()->randomLetter,
    ];
});

$factory->define(App\Role::class, function (Faker\Generator $faker) {
	$word = $faker->unique()->text($maxNbChars = 5);
    return [
        'name' => $word,
		    'slug' => $word
    ];
});

$factory->define(App\Message::class, function (Faker\Generator $faker) {

    return [
        'from' => function() {
            return factory(App\User::class)->create()->id;
        },
		    'to' => function() {
            return factory(App\User::class)->create()->id;
        },
        'topic' => $faker -> word,
        'content' => $faker -> word,
        'status' => rand(0,1)
    ];
});

$factory->define(App\Subjects::class, function (Faker\Generator $faker) {

    return [
        'name' => $faker->unique()->word,
        'leading_teacher' => function() {
            return factory(App\User::class)->create()->id;
        }
    ];
});
