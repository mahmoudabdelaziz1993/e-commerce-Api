<?php

use App\Category;
use App\Product;
use App\User;

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
        'varified'=>$varified=$faker->randomElement([User::VARIFIED_USER,User::UNVARIFIED_USER]),
        'varified_token'=>$varified==User::VARIFIED_USER ? null : User::generateVarificationCode(),
        'admin'=>$faker->randomElement([User::ADMIN_USER,User::REGULAR_USER]),
    ];
});

// ---------------------- factory for category--------------------------

$factory->define(App\Category::class, function (Faker\Generator $faker) {
    

    return [
        'name' => $faker->name,
        'description' => $faker->word,
            ];
});


//---------------------------------factorey for products-----------------

$factory->define(App\Product::class, function (Faker\Generator $faker) {
    

    return [
        'name'=>$faker->name,
        'description'=> $faker->word,
        'quantity'=>$faker->numberBetween(1,10),
        'quantity'=>$quantity=$faker->numberBetween(0,10),
         'status'=>$quantity == 0? Product::UNAVAILABLE_PRO:$faker->randomElement([Product::AVAILABLE_PRO,Product::UNAVAILABLE_PRO]),
         'image'=>$faker->randomElement(['1.jpeg','2.jpg','3.jpg']),
         'seller_id'=>User::all()->random()->id,
         'category_id'=>Category::all()->random()->id,
            ];
});

// ---------------------- factory for transaction--------------------------

$factory->define(App\Transaction::class, function (Faker\Generator $faker) {
   // $seller = User::has('product')->get()->random();
    //$buyer= User::all()->except($seller->id)->random();

    return [
         'quantity'=>$faker->numberBetween(1,5),
        'buyer_id'=>User::all()->random()->id,
        'product_id'=>Product::all()->random()->id,
            ];
});

