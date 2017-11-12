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
    $name = $faker->name();

    return [
        'name' => $name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
        'slug' => str_slug($name, '-'),
        'game_played' => rand(0, 120),
        'role_id' => rand(1, 5),
    ];
});

$factory->define(App\Article::class, function (Faker\Generator $faker) {
    static $password;
    $title = $faker->sentence(2);
    $content = $faker->paragraph(rand(8, 15));

    return [
        'title' => $title,
        'slug' => str_slug($title, '-'),
        'summary' => substr($content, 0, 128),
        'content' => $content,
        'user_id' => rand(1, 49),
    ];
});

$factory->define(App\Game::class, function (Faker\Generator $faker) {
    static $password;
    $title = $faker->sentence(rand(2, 8));
    $synopsis = $faker->paragraph(rand(8, 20));
    $status = array('ACTIVE', 'PENDING', 'ENDED', 'CANCELED');
    shuffle($status);
    return [
        'title' => $title,
        'slug' => str_slug($title, '-'),
        'summary' => substr($synopsis, 0, 200),
        'synopsis' => $synopsis,
        'where' => $faker->address,
        'when' => $faker->dateTime,
        'status' => $status[0],
        'pj_limit' => rand(2, 38),
        'author' => rand(1, 30),
        
    ];
});