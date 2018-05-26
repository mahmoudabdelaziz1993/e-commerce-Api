<?php

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        // $this->call(UsersTableSeeder::class);
         Factory(App\User::class,200)->create();
         Factory(App\Category::class,50)->create();
         Factory(App\Product::class,50)->create();
         Factory(App\Transaction::class,50)->create();
         
    }
}
