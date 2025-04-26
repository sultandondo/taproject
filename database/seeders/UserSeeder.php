<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Make sure the User model is imported
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run()
    {
        // Create a user with a specific email and password
        User::create([
            'name' => 'sultan',
            'email' => 'sultan@gmail.com',
            'password' => Hash::make('password'), // Hash the password
        ]);
    }
}
