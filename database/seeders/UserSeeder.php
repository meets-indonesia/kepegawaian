<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\User;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define users with their corresponding roles
        $users = [
            [
                'username' => 'Super Admin',
                'email' => 'superadmin@example.com',
                'password' => Hash::make('password'), // Use hashed passwords
                'role_id' => 1, // Assuming role_id 1 corresponds to superadmin
                'last_login' => now(),
            ],
            [
                'username' => 'Admin User',
                'email' => 'admin@example.com',
                'password' => Hash::make('password'),
                'role_id' => 2, // Assuming role_id 2 corresponds to admin
                'last_login' => now(),
            ],
            [
                'username' => 'Regular User',
                'email' => 'user@example.com',
                'password' => Hash::make('password'),
                'role_id' => 3, // Assuming role_id 3 corresponds to user
                'last_login' => now(),
            ],
        ];

        // Insert the users into the database
        foreach ($users as $user) {
            User::create($user);
        }
    }
}
