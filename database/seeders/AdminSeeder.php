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
        $adminEmail = config('app.admin_email', env('APP_ADMIN_EMAIL', 'operaciones@lanexsac.com'));
        $adminPassword = config('app.admin_password', env('APP_ADMIN_PASSWORD', 'lanex2025!'));

        User::updateOrCreate(
            ['email' => $adminEmail],
            [
                'name' => 'Administrador LanEx',
                'password' => Hash::make($adminPassword),
                'role' => 'admin',
                'is_active' => true,
            ]
        );
    }
}
