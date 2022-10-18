<?php

namespace Database\Seeders;

use App\Models\User;
use App\Models\Listing;
use Illuminate\Database\Seeder;
// use Illuminate\Foundation\Auth\User;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();

        // Listing::factory(6)->create();

        // create a user
        // decide for certain fields with create() method
        $user = User::factory()->create([
            "name" => "John Doe",
            "email" => "john@gmail.com"
        ]);

        // create 6 listings associated with the user that was just created
        Listing::factory(6)->create([
            "user_id" => $user->id
        ]); 
    }
}
