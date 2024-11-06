<?php

namespace Database\Seeders;

use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Seeder;
use App\Models\User;


class AdminSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        User::create([
            'name' => 'admin', // Set a default name, or pull from .env if needed
            'email' => env('APP_ADMIN_EMAIL'), // Retrieve the admin email from .env
            'password' => Hash::make(env('APP_ADMIN_PASSWORD')), // Set a default password or use env('APP_ADMIN_PASSWORD')
        ]);
    }
}
