<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class SecondAdminSeeder extends Seeder
{
    public function run(): void
    {
        User::firstOrCreate([
            'name' => 'Second Admin',
            'email' => 'admin2@example.com',
            'password' => Hash::make('Admin@12345'),
            'role' => 'admin',
        ]);
    }
}
