<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Role;

class RoleSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        // Define the roles with their corresponding levels and authorities
        $roles = [
            [
                'name' => 'superadmin',
                'description' => 'Has access to all system features and settings.',
                'level' => 1,
            ],
            [
                'name' => 'admin',
                'description' => 'Can manage users and moderate content.',
                'level' => 2,
            ],
            [
                'name' => 'user',
                'description' => 'Regular user with standard access.',
                'level' => 3,
            ],
        ];

        // Insert the roles into the database
        foreach ($roles as $role) {
            Role::create($role);
        }
    }
}
