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
$genre = [
    'Comedy',
    'Drama',
    'Fiction',
    'Novel',
    'Satire',
    'Tragedy',
    'Tragicomedy',
    'Horror'
];
$factory->define(App\User::class, function (Faker\Generator $faker) {
    return [
        'firstname' => $faker->firstName,
        'email' => $faker->safeEmail,
        'lastname' =>$faker->lastName
    ];
});
$factory->define(App\Book::class, function (Faker\Generator $faker) use ($genre) {
    return [
        'title' => $faker->word,
        'author' => $faker->name,
        'year' => $faker->year,
        'genre' => $genre[rand(0, count($genre) - 1)]
    ];
});