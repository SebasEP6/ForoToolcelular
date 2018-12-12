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

$factory->define(Foro\User::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
        'email' => $faker->email,
        'password' => 'secret',
        'remember_token' => str_random(10),
        'role' => $faker->randomElement(['member', 'privilege', 'moderator', 'support', 'admin']),
        'user' => $faker->userName,
        'sex' => $faker->randomElement(['male', 'female']),
        'birthdate' => $faker->dateTime($max = '-10 years'),
        'country' => $faker->country,
        'slogan' => $faker->sentence,
        'website_url' => $faker->domainName
    ];
});
$factory->define(Foro\Post::class, function (Faker\Generator $faker) {
    return [
        'title' => $faker->sentence,
        'body' => $faker->text,
        'category_id' => $faker->numberBetween($min = 1, $max = 4),
        'user_id' => $faker->numberBetween($min = 1, $max = 100),
        'type' => $faker->randomElement(['video', 'doubt', 'archive', 'image'])
    ];
});
$factory->define(Foro\Comment::class, function (Faker\Generator $faker) {
    return [
        'comment' => $faker->text,
        'post_id' => $faker->numberBetween($min = 1, $max = 300),
        'user_id' => $faker->numberBetween($min = 1, $max = 100)
    ];
});
$factory->define(Foro\Message::class, function (Faker\Generator $faker) {
    return [
        'message' => $faker->text,
        'sent_id' => $faker->numberBetween($min = 1, $max = 100),
        'receive_id' => $faker->numberBetween($min = 1, $max = 100)
    ];
});

