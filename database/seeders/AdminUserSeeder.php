<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class AdminUserSeeder extends Seeder
{
    public function run(): void
    {
        User::updateOrCreate(
            ['username' => 'mwrueen'],
            [
                'name' => 'Md Mehedi Hasan Rueen',
                'username' => 'mwrueen',
                'email' => 'mwrueen@admin.com',
                'password' => Hash::make('P@ssw0rd'),
                'email_verified_at' => now(),
            ]
        );
    }
}
