<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    /**
     * Seed the default administrator account.
     */
    public function run(): void
    {
        $admin = User::updateOrCreate(
            ['email' => env('ADMIN_EMAIL', 'admin@example.com')],
            [
                'name' => env('ADMIN_NAME', 'Administrator'),
                'fname' => env('ADMIN_FNAME', 'Admin'),
                'mname' => env('ADMIN_MNAME'),
                'lname' => env('ADMIN_LNAME', 'User'),
                'contactno' => env('ADMIN_CONTACTNO'),
                'password' => Hash::make(env('ADMIN_PASSWORD', 'password')),
                'role' => 'admin',
                'must_change_password' => false,
            ]
        );

        $this->command?->info("Admin user ready: {$admin->email}");
    }
}
