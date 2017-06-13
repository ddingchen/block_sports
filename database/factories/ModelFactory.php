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
        'name' => $faker->name,
        'email' => $faker->unique()->safeEmail,
        'password' => $password ?: $password = bcrypt('secret'),
        'remember_token' => str_random(10),
    ];
});

$factory->define(App\Wm\Group::class, function (Faker\Generator $faker) {
    return [
        'name' => $faker->name,
    ];
});

$factory->define(App\Wm\Ticket::class, function (Faker\Generator $faker) {

    // $ownerType = $faker->boolean ? 'App\User' : 'App\Wm\RegisterTeam';
    // $owner = factory($ownerType)->create();
    // if ($ownerType == 'App\Wm\RegisterTeam') {
    //     $owner->members()->saveMany(factory('App\User', 4)->create());
    // }

    return [
        'group_id' => function () {
            return factory('App\Wm\Group')->create()->id;
        },
        'user_id' => factory('App\User')->create()->id,
        'registion_id' => factory('App\Wm\Registion')->create()->id,
        'registion_type' => 'App\Wm\Registion',
    ];
});

$factory->define(App\Wm\Registion::class, function (Faker\Generator $faker) {
    if ($faker->boolean(80)) {
        $birthday = $faker->dateTimeBetween('-60 years', '-18 years');
    } else {
        $birthday = $faker->dateTimeBetween('-15 years', '-13 years');
    }

    return [
        'realname' => $faker->name,
        'sex' => $faker->boolean ? 'male' : 'female',
        'idcard_no' => $faker->randomNumber(6, true) . $birthday->format('Ymd') . $faker->randomNumber(4, true),
        'tel' => '13812084569',
    ];
});
