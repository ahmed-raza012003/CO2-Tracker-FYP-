<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User; // Adjust this according to your User model's namespace

class AdminUserSeeder extends Seeder
{
    public function run()
    {
        User::create([
            'name' => 'Admin User',
            'email' => 'admin@example.com',
            'password' => bcrypt('password'), // Use a strong password
            // Add other necessary fields as per your User model
        ]);
    }
}
