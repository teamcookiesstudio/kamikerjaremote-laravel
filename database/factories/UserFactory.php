<?php

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

$factory->define(App\User::class, function (Faker $faker) {
    return [
        'first_name'     => $faker->firstName,
        'last_name'      => $faker->lastName,
        'email'          => $faker->unique()->safeEmail,
        'password'       => '$2y$10$TKh8H1.PfQx37YgCzwiKb.KjNyWgaHb9cbcoQgdIVFlYg7B77UdFm', // secret
        'remember_token' => str_random(10),
        'level'          => rand(1, 2),
    ];
});

$factory->define(App\Models\Profile::class, function (Faker $faker) {
    return [
        'member_id'         => rand(1, 3),
        'occupation'        => $faker->jobTitle,
        'location'          => $faker->randomElement(['Bandung', 'Jakarta', 'Jogja']),
        'summary'           => $faker->sentence,
        'website'           => 'http://'.$faker->domainName,
        'url_photo_profile' => $faker->imageUrl,
    ];
});

$factory->define(App\Models\Portofolio::class, function (Faker $faker) {
    return [
        'member_id'        => rand(1, 3),
        'project_name'     => $faker->name,
        'start_date'       => date('Y-m-d H:i:s'),
        'end_date'         => date('Y-m-d H:i:s'),
        'project_on_going' => false,
        'thumbnail'        => null,
        'description'      => $faker->text,
        'created_at'       => date('Y-m-d H:i:s'),
        'updated_at'       => date('Y-m-d H:i:s'),
    ];
});
