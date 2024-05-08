<?php

namespace Database\Seeders;

// use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     */
    public function run(): void
    {
        // \App\Models\RestaurantsUser::factory(1)->create();

        // \App\Models\RestaurantsUser::factory()->create([
        //     'name' => 'Test Restaurant',
        //     'email' => 'restaurant@example.com',
        //     'password' => Hash::make('123456789'),
        // ]);
        \App\Models\User::factory()->create([
            'name' => 'Test User',
            'email' => 'User@example.com',
            'password' => Hash::make('123456789'),
        ]);
    }
}
