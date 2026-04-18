<?php

namespace Database\Seeders;

use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;

class UserSeeder extends Seeder
{
    public function run(): void
    {
        $manager = User::firstOrCreate(
            ['email' => 'test@gmail.com'],
            [
                'name' => 'Александр',
                'password' => Hash::make('1234567890'),
            ]
        );

        $manager->assignRole('manager');
    }
}